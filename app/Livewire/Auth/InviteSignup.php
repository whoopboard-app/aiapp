<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Modules\Settings\Models\WorkspaceInvitation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class InviteSignup extends Component
{
    use WithFileUploads;

    public $token;
    public $invitation;

    // Form fields
    public $firstName = '';
    public $lastName = '';
    public $email = '';
    public $role = '';
    public $password = '';
    public $password_confirmation = '';
    public $profileImage;
    public $timezone = 'UTC';

    // State
    public $tokenValid = false;
    public $errorMessage = '';

    // Timezone options (common timezones)
    public $timezones = [
        'UTC' => 'UTC',
        'America/New_York' => 'Eastern Time (US & Canada)',
        'America/Chicago' => 'Central Time (US & Canada)',
        'America/Denver' => 'Mountain Time (US & Canada)',
        'America/Los_Angeles' => 'Pacific Time (US & Canada)',
        'America/Anchorage' => 'Alaska',
        'America/Phoenix' => 'Arizona',
        'Pacific/Honolulu' => 'Hawaii',
        'Europe/London' => 'London',
        'Europe/Paris' => 'Paris',
        'Europe/Berlin' => 'Berlin',
        'Europe/Istanbul' => 'Istanbul',
        'Asia/Dubai' => 'Dubai',
        'Asia/Karachi' => 'Karachi',
        'Asia/Kolkata' => 'Kolkata',
        'Asia/Shanghai' => 'Shanghai',
        'Asia/Tokyo' => 'Tokyo',
        'Asia/Hong_Kong' => 'Hong Kong',
        'Asia/Singapore' => 'Singapore',
        'Australia/Sydney' => 'Sydney',
        'Pacific/Auckland' => 'Auckland',
    ];

    protected $rules = [
        'firstName' => 'required|string|min:2|max:255|regex:/^[a-zA-Z\s]+$/',
        'lastName' => 'required|string|min:2|max:255|regex:/^[a-zA-Z\s]+$/',
        'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/',
        'profileImage' => 'nullable|image|max:2048',
        'timezone' => 'nullable|string',
    ];

    protected $messages = [
        'firstName.required' => 'Please enter your first name.',
        'firstName.regex' => 'First name can only contain letters.',
        'lastName.required' => 'Please enter your last name.',
        'lastName.regex' => 'Last name can only contain letters.',
        'password.required' => 'Please enter a password.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        'password.confirmed' => 'Password confirmation does not match.',
    ];

    public function mount($token)
    {
        $this->token = $token;

        // Find invitation by token
        $this->invitation = WorkspaceInvitation::findByToken($token);

        if (!$this->invitation) {
            $this->errorMessage = 'Invalid invitation link.';
            return;
        }

        if ($this->invitation->isExpired()) {
            $this->errorMessage = 'This invitation has expired. Please contact your workspace admin for a new invitation.';
            return;
        }

        if ($this->invitation->status !== 'pending') {
            $this->errorMessage = 'This invitation has already been used.';
            return;
        }

        // Load invitation details
        $this->email = $this->invitation->email;
        $this->role = $this->invitation->role;
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
            $profileImagePath = null;

            // Handle profile image upload
            if ($this->profileImage) {
                $profileImagePath = $this->profileImage->store('profile-images', 'public');
            }

            // Create user
            $user = User::create([
                'workspace_id' => $this->invitation->workspace_id,
                'name' => trim($this->firstName . ' ' . $this->lastName),
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'email' => $this->email,
                'profile_image' => $profileImagePath,
                'password' => Hash::make($this->password),
                'role' => $this->role,
                'timezone' => $this->timezone ?? 'UTC',
            ]);

            // Mark email as verified since they came from invitation
            $user->markEmailAsVerified();

            // Mark invitation as accepted
            $this->invitation->markAsAccepted();

            DB::commit();

            // Log the user in
            Auth::login($user);

            // Redirect to dashboard
            return redirect()->route('workspace.dashboard');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('firstName', 'An error occurred during registration. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.auth.invite-signup')
            ->layout('layouts.guest');
    }
}
