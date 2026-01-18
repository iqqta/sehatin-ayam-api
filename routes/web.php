<?php

use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\TreatmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('diseases', DiseaseController::class);
    Route::resource('symptoms', SymptomController::class);
    Route::resource('rules', RuleController::class);
    Route::resource('treatments', TreatmentController::class);

    Route::post('/publish-update', [\App\Http\Controllers\PublishUpdateController::class, 'store'])->name('publish.update');
});

require __DIR__.'/auth.php';
