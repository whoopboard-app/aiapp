<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('workspace.dashboard');
    }
    return redirect()->route('login');
})->name('home');

// Convenience redirect for /dashboard
Route::get('/dashboard', function () {
    return redirect()->route('workspace.dashboard');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
| Load all modular route files
*/

require __DIR__.'/auth.php';
require __DIR__.'/onboarding.php';
require __DIR__.'/workspace.php';
require __DIR__.'/settings.php';
require __DIR__.'/app.php';
