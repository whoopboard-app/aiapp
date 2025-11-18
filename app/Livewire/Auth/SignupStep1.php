<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Modules\Auth\Models\PendingRegistration;
use App\Notifications\VerifyEmailForSignup;
use Illuminate\Support\Facades\Notification;

class SignupStep1 extends Component
{
    public $email = '';
    public $emailSent = false;

    protected $rules = [
        'email' => 'required|email|max:255|unique:users,email',
    ];

    protected $messages = [
        'email.required' => 'Please enter your work email address.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already registered. Please log in instead.',
    ];

    public function submitEmail()
    {
        $this->validate();

        // Create pending registration
        $pendingRegistration = PendingRegistration::createForEmail($this->email);

        // Send verification email
        Notification::route('mail', $this->email)
            ->notify(new VerifyEmailForSignup($pendingRegistration));

        $this->emailSent = true;
    }

    public function resendEmail()
    {
        $this->emailSent = false;
        $this->submitEmail();
    }

    public function render()
    {
        return view('livewire.auth.signup-step1')
            ->layout('layouts.guest');
    }
}
