<?php

use App\Livewire\Auth\SignupStep1;
use App\Livewire\Auth\SignupStep2;
use App\Livewire\Auth\Login;
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

    // Login
    Route::get('/login', Login::class)->name('login');

    // Password Reset (placeholder - implement later)
    // Route::get('/forgot-password', ...)->name('password.request');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/');
    })->name('logout');
});
