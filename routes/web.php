<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
| Load all modular route files
*/

require __DIR__.'/auth.php';
require __DIR__.'/onboarding.php';
require __DIR__.'/workspace.php';
require __DIR__.'/app.php';
