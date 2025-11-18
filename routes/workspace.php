<?php

use App\Modules\Workspace\Controllers\WorkspaceController;
use App\Modules\Workspace\Controllers\WorkspaceSettingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Workspace Routes
|--------------------------------------------------------------------------
| Routes for workspace management (not multi-tenant subdomains yet)
*/

Route::middleware(['auth'])->prefix('workspace')->name('workspace.')->group(function () {
    // Workspace Dashboard
    Route::get('/', [WorkspaceController::class, 'index'])->name('index');
    Route::get('/dashboard', [WorkspaceController::class, 'dashboard'])->name('dashboard');
    
    // Workspace Settings
    Route::get('/settings', [WorkspaceSettingsController::class, 'show'])->name('settings');
    Route::put('/settings', [WorkspaceSettingsController::class, 'update'])->name('settings.update');
    
    // Team Members (future)
    // Route::resource('members', WorkspaceMemberController::class);
});
