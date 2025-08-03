<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Task routes
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/favorites', [TaskController::class, 'favorites'])->name('tasks.favorites');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::post('/tasks/{id}/submit', [TaskController::class, 'submitTask'])->name('tasks.submit');
    Route::put('/tasks/{id}/update-submission', [TaskController::class, 'updateSubmission'])->name('tasks.update-submission');
    Route::post('/tasks/{id}/favorite', [TaskController::class, 'toggleFavorite'])->name('tasks.favorite');
    
    // Point routes
    Route::get('/points', [PointController::class, 'index'])->name('points.index');
    Route::get('/points/withdraw', [PointController::class, 'withdraw'])->name('points.withdraw');
    Route::post('/points/withdraw', [PointController::class, 'processWithdraw'])->name('points.process-withdraw');
    
    // Submission routes
    Route::get('/submissions', [SubmissionController::class, 'index'])->name('submissions.index');
});

require __DIR__.'/auth.php';
