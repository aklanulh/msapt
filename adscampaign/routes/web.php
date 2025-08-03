<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\RedeemController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\AdminTaskController;
use App\Http\Controllers\Admin\AdminSubmissionController;
use App\Http\Controllers\Admin\AdminRedeemController;
use App\Http\Controllers\DashboardController;





Route::get('/', function () {
    return view('welcome');
});

// Route untuk Admin Dashboard
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/tasks', [AdminTaskController::class, 'index'])->name('admin.tasks.index');
    Route::get('/admin/tasks/create', [AdminTaskController::class, 'create'])->name('admin.tasks.create');
    Route::post('/admin/tasks', [AdminTaskController::class, 'store'])->name('admin.tasks.store');
    Route::delete('/admin/tasks/{id}', [AdminTaskController::class, 'destroy'])->name('admin.tasks.destroy');
    Route::get('/admin/tasks/{task}/edit', [AdminTaskController::class, 'edit'])->name('admin.tasks.edit');
    Route::patch('/admin/tasks/{id}', [AdminTaskController::class, 'update'])->name('admin.tasks.update');

    Route::get('/admin/submissions', [AdminSubmissionController::class, 'index'])->name('admin.submissions');
    Route::post('/admin/submissions/{id}/approve', [AdminSubmissionController::class, 'approve'])->name('approve-submission');
    Route::post('/admin/submissions/{id}/reject', [AdminSubmissionController::class, 'reject'])->name('reject-submission');

    Route::get('/admin/redeems', [AdminRedeemController::class, 'redeems'])->name('admin.redeems');
    Route::post('/admin/redeems/approve/{id}', [AdminRedeemController::class, 'approve'])->name('approve-redeem');
    Route::post('/admin/redeems/reject/{id}', [AdminRedeemController::class, 'reject'])->name('reject-redeem');

    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');

    Route::get('/submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::post('/submissions', [SubmissionController::class, 'store'])->name('submissions.store');

    Route::get('/redeems', [RedeemController::class, 'index'])->name('redeems.index');
    Route::post('/redeems', [RedeemController::class, 'store'])->name('redeems.store');

    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
});

require __DIR__ . '/auth.php';
