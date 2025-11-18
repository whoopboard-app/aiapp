<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Modules\Workspace\Models\Workspace;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SignupStep1 extends Component
{
    public $email = '';
    public $workspaceName = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'email' => 'required|email|max:255|unique:users,email',
        'workspaceName' => 'required|string|min:2|max:255',
        'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/',
    ];

    protected $messages = [
        'email.required' => 'Please enter your work email address.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already registered. Please log in instead.',
        'workspaceName.required' => 'Please enter your workspace name.',
        'workspaceName.min' => 'Workspace name must be at least 2 characters.',
        'password.required' => 'Please enter a password.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        'password.confirmed' => 'Password confirmation does not match.',
    ];

    public function submitSignup()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            // Create workspace
            $workspace = Workspace::create([
                'name' => $this->workspaceName,
                'slug' => Workspace::generateSlug($this->workspaceName),
                'is_active' => true,
            ]);

            // Create user as workspace owner
            $user = User::create([
                'workspace_id' => $workspace->id,
                'name' => explode('@', $this->email)[0], // Use email prefix as name
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => 'owner', // First user is the workspace owner
            ]);

            DB::commit();

            // Log the user in
            Auth::login($user);

            // Send email verification notification
            $user->sendEmailVerificationNotification();

            // Redirect to email verification notice
            return redirect()->route('verification.notice');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('email', 'An error occurred during registration. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.auth.signup-step1')
            ->layout('layouts.guest');
    }
}
