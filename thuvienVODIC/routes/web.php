<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\DataRequestController as AdminRequestController;
use App\Http\Controllers\Admin\MinistryController;
use App\Http\Controllers\Client\HomeController; // Controller chính Client

/* --- KHÁCH (PUBLIC) --- */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gui-yeu-cau', [HomeController::class, 'createRequest'])->name('client.request.create');
Route::post('/gui-yeu-cau', [HomeController::class, 'storeRequest'])->name('client.request.store');
Route::get('/du-an/{id}', [HomeController::class, 'showProject'])->name('client.project.detail');

/* --- ADMIN (PRIVATE) --- */
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('projects', AdminProjectController::class);
    Route::resource('documents', AdminDocumentController::class);
    Route::resource('data_requests', AdminRequestController::class)->only(['index', 'update', 'destroy']);
    Route::patch('/data_requests/{id}/update-status', [AdminRequestController::class, 'update'])->name('data_requests.update_status');
    Route::resource('ministries', MinistryController::class);
});

/* --- AUTH --- */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';