<?php

use App\Livewire\Auth\SignupStep1;
use App\Livewire\Auth\SignupStep2;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\InviteSignup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Sign Up Flow
    Route::get('/signup', SignupStep1::class)->name('signup');
    Route::get('/signup/verify/{token}', SignupStep2::class)->name('signup.verify');

    // Invite Sign Up
    Route::get('/invite/{token}', InviteSignup::class)->name('invite.signup');

    // Login
    Route::get('/login', Login::class)->name('login');

    // Password Reset (placeholder - implement later)
    // Route::get('/forgot-password', ...)->name('password.request');
});

Route::middleware('auth')->group(function () {
    // Email Verification
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('onboarding.start');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/resend', function (\Illuminate\Http\Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.resend');

    // Logout
    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/');
    })->name('logout');
});
