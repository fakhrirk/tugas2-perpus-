<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TamuController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminOnly;

Route::get('/', function () {
    return view('welcome');
});

// Admin routes with AdminOnly middleware
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Book routes for admin only
    Route::resource('books', BookController::class);
});

// Route for guests (non-admin users)
Route::middleware('auth')->group(function () {
    Route::get('/tamu/dashboard', [TamuController::class, 'dashboard'])->name('tamu.dashboard');
});

// Profile routes for all authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
