<?php

use App\Livewire\Onboarding\OnboardingGoals;
use App\Livewire\Onboarding\OnboardingWorkspaceInfo;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Onboarding Routes
|--------------------------------------------------------------------------
| Multi-step onboarding flow for new users
*/

Route::middleware(['auth', 'verified'])->prefix('onboarding')->name('onboarding.')->group(function () {
    // Redirect /onboarding to /onboarding/start
    Route::get('/', function () {
        return redirect()->route('onboarding.start');
    });
    
    // Step 1: Select Goals
    Route::get('/start', OnboardingGoals::class)->name('start');
    
    // Step 2: Workspace Info
    Route::get('/workspace-info', OnboardingWorkspaceInfo::class)->name('workspace-info');
});
