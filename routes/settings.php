<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\General;
use App\Livewire\Settings\Invite;
use App\Livewire\Settings\Script;
use App\Livewire\Settings\StatusWorkflow;
use App\Livewire\Settings\TopicsTags;
use App\Livewire\Settings\Changelog as ChangelogSettings;
use App\Livewire\Settings\Themes;
use App\Livewire\Settings\Plan;
use App\Livewire\Settings\Billing;
use App\Livewire\Settings\Plans;

/*
|--------------------------------------------------------------------------
| Settings Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('settings')->name('settings.')->group(function () {
    // Redirect /settings to /settings/general
    Route::get('/', function () {
        return redirect()->route('settings.general');
    })->name('index');

    // General Settings
    Route::get('/general', General::class)->name('general');

    // Invite Settings
    Route::get('/invite', Invite::class)->name('invite');

    // Script Settings (Coming Soon)
    Route::get('/script', Script::class)->name('script');

    // Status Workflow
    Route::get('/status-workflow', StatusWorkflow::class)->name('status-workflow');

    // Topics & Tags
    Route::get('/topics-tags', TopicsTags::class)->name('topics-tags');

    // Changelog Settings
    Route::get('/changelog', ChangelogSettings::class)->name('changelog');

    // Themes
    Route::get('/themes', Themes::class)->name('themes');

    // Plan
    Route::get('/plan', Plan::class)->name('plan');

    // Billing
    Route::get('/billing', Billing::class)->name('billing');

    // Plans
    Route::get('/plans', Plans::class)->name('plans');
});
