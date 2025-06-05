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

Route::middleware(['auth'])->group(function () { // Assuming it's behind authentication
    Route::get('/users', function () {
        // In a real scenario, you'd fetch users from the database via a Controller
        // $users = User::paginate(10); // Example
        return view('users.index' /*, compact('users')*/);
    })->name('users.index');

    Route::get('/users/create', function () {
        return view('users.create'); // You'll need to create this view
    })->name('users.create');

    // Potentially routes for store, edit, update, destroy
    // Route::resource('users', UserController::class)->except(['show']); // If using a resource controller
});

require __DIR__.'/auth.php';
