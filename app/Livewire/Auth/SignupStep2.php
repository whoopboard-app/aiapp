<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Modules\Auth\Models\PendingRegistration;
use App\Modules\Workspace\Models\Workspace;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SignupStep2 extends Component
{
    public $token;
    public $email;
    public $workspaceName = '';
    public $password = '';
    public $password_confirmation = '';
    
    public $tokenValid = false;
    public $errorMessage = '';

    protected $rules = [
        'workspaceName' => 'required|string|min:2|max:255',
        'password' => 'required|string|min:8|confirmed',
    ];

    protected $messages = [
        'workspaceName.required' => 'Please enter your workspace name.',
        'workspaceName.min' => 'Workspace name must be at least 2 characters.',
        'password.required' => 'Please enter a password.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.confirmed' => 'Password confirmation does not match.',
    ];

    public function mount($token)
    {
        $this->token = $token;
        
        // Find pending registration
        $pendingReg = PendingRegistration::findByToken($token);
        
        if (!$pendingReg) {
            $this->errorMessage = 'Invalid verification link.';
            return;
        }
        
        if ($pendingReg->isExpired()) {
            $this->errorMessage = 'This verification link has expired. Please request a new one.';
            return;
        }
        
        if ($pendingReg->verified_at) {
            $this->errorMessage = 'This email has already been verified and used to create an account.';
            return;
        }
        
        // Mark as verified
        $pendingReg->markAsVerified();
        
        $this->email = $pendingReg->email;
        $this->tokenValid = true;
    }

    public function completeSignup()
    {
        if (!$this->tokenValid) {
            return;
        }

        $this->validate();

        DB::beginTransaction();
        try {
            // Create workspace
            $workspace = Workspace::create([
                'name' => $this->workspaceName,
                'slug' => Workspace::generateSlug($this->workspaceName),
                'is_active' => true,
            ]);

            // Create user
            $user = User::create([
                'workspace_id' => $workspace->id,
                'name' => explode('@', $this->email)[0], // Use email prefix as name
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'email_verified_at' => now(),
            ]);

            // Delete pending registration
            PendingRegistration::where('email', $this->email)->delete();

            DB::commit();

            // Log the user in
            Auth::login($user);

            // Redirect to onboarding
            return redirect()->route('onboarding.start');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('workspaceName', 'An error occurred during registration. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.auth.signup-step2')
            ->layout('layouts.guest');
    }
}
