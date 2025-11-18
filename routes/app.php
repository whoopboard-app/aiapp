<?php

use App\Modules\Feedback\Controllers\FeedbackController;
use App\Modules\Changelog\Controllers\ChangelogController;
use App\Modules\Knowledge\Controllers\KnowledgeController;
use App\Modules\Research\Controllers\ResearchController;
use App\Modules\Personas\Controllers\PersonaController;
use App\Modules\Journey\Controllers\JourneyController;
use App\Modules\Testimonials\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes (Core Modules)
|--------------------------------------------------------------------------
| Main SaaS features - all require authentication
*/

Route::middleware(['auth'])->group(function () {
    
    // Feedback Module
    Route::prefix('feedback')->name('feedback.')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('index');
        Route::get('/create', [FeedbackController::class, 'create'])->name('create');
        Route::post('/', [FeedbackController::class, 'store'])->name('store');
        Route::get('/{feedback}', [FeedbackController::class, 'show'])->name('show');
        Route::get('/{feedback}/edit', [FeedbackController::class, 'edit'])->name('edit');
        Route::put('/{feedback}', [FeedbackController::class, 'update'])->name('update');
        Route::delete('/{feedback}', [FeedbackController::class, 'destroy'])->name('destroy');
    });
    
    // Changelog Module
    Route::prefix('changelog')->name('changelog.')->group(function () {
        Route::get('/', [ChangelogController::class, 'index'])->name('index');
        Route::get('/create', [ChangelogController::class, 'create'])->name('create');
        Route::post('/', [ChangelogController::class, 'store'])->name('store');
        Route::get('/{changelog}', [ChangelogController::class, 'show'])->name('show');
        Route::get('/{changelog}/edit', [ChangelogController::class, 'edit'])->name('edit');
        Route::put('/{changelog}', [ChangelogController::class, 'update'])->name('update');
        Route::delete('/{changelog}', [ChangelogController::class, 'destroy'])->name('destroy');
    });
    
    // Knowledge Base Module
    Route::prefix('knowledge')->name('knowledge.')->group(function () {
        Route::get('/', [KnowledgeController::class, 'index'])->name('index');
        Route::get('/create', [KnowledgeController::class, 'create'])->name('create');
        Route::post('/', [KnowledgeController::class, 'store'])->name('store');
        Route::get('/{article}', [KnowledgeController::class, 'show'])->name('show');
        Route::get('/{article}/edit', [KnowledgeController::class, 'edit'])->name('edit');
        Route::put('/{article}', [KnowledgeController::class, 'update'])->name('update');
        Route::delete('/{article}', [KnowledgeController::class, 'destroy'])->name('destroy');
    });
    
    // Research Module
    Route::prefix('research')->name('research.')->group(function () {
        Route::get('/', [ResearchController::class, 'index'])->name('index');
        Route::get('/create', [ResearchController::class, 'create'])->name('create');
        Route::post('/', [ResearchController::class, 'store'])->name('store');
        Route::get('/{research}', [ResearchController::class, 'show'])->name('show');
        Route::get('/{research}/edit', [ResearchController::class, 'edit'])->name('edit');
        Route::put('/{research}', [ResearchController::class, 'update'])->name('update');
        Route::delete('/{research}', [ResearchController::class, 'destroy'])->name('destroy');
    });
    
    // Personas Module
    Route::prefix('personas')->name('personas.')->group(function () {
        Route::get('/', [PersonaController::class, 'index'])->name('index');
        Route::get('/create', [PersonaController::class, 'create'])->name('create');
        Route::post('/', [PersonaController::class, 'store'])->name('store');
        Route::get('/{persona}', [PersonaController::class, 'show'])->name('show');
        Route::get('/{persona}/edit', [PersonaController::class, 'edit'])->name('edit');
        Route::put('/{persona}', [PersonaController::class, 'update'])->name('update');
        Route::delete('/{persona}', [PersonaController::class, 'destroy'])->name('destroy');
    });
    
    // Journey Maps Module
    Route::prefix('journey')->name('journey.')->group(function () {
        Route::get('/', [JourneyController::class, 'index'])->name('index');
        Route::get('/create', [JourneyController::class, 'create'])->name('create');
        Route::post('/', [JourneyController::class, 'store'])->name('store');
        Route::get('/{journey}', [JourneyController::class, 'show'])->name('show');
        Route::get('/{journey}/edit', [JourneyController::class, 'edit'])->name('edit');
        Route::put('/{journey}', [JourneyController::class, 'update'])->name('update');
        Route::delete('/{journey}', [JourneyController::class, 'destroy'])->name('destroy');
    });
    
    // Testimonials Module
    Route::prefix('testimonials')->name('testimonials.')->group(function () {
        Route::get('/', [TestimonialController::class, 'index'])->name('index');
        Route::get('/create', [TestimonialController::class, 'create'])->name('create');
        Route::post('/', [TestimonialController::class, 'store'])->name('store');
        Route::get('/{testimonial}', [TestimonialController::class, 'show'])->name('show');
        Route::get('/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('edit');
        Route::put('/{testimonial}', [TestimonialController::class, 'update'])->name('update');
        Route::delete('/{testimonial}', [TestimonialController::class, 'destroy'])->name('destroy');
    });
});
