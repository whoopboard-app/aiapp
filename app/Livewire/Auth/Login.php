<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ];

    protected $messages = [
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'Please enter your password.',
        'password.min' => 'Password must be at least 8 characters.',
    ];

    /**
     * Attempt to authenticate the user
     */
    public function login()
    {
        $this->validate();

        // Attempt to authenticate
        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match our records.',
            ]);
        }

        // Regenerate session
        session()->regenerate();

        // Check if user has completed onboarding
        if (Auth::user()->hasCompletedOnboarding()) {
            return redirect()->intended(route('workspace.dashboard'));
        }

        // Redirect to onboarding if not completed
        return redirect()->route('onboarding.start');
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('layouts.guest');
    }
}
