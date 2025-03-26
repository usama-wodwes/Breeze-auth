<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;

// Home Page - Redirect to Listings
Route::get('/', [ListingController::class, 'index'])->name('listings.index');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/listings', [ListingController::class, 'index']);
    Route::get('/listings/create', [ListingController::class, 'create']);
    Route::post('/listings', [ListingController::class, 'store']);
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);
    Route::put('/listings/{listing}', [ListingController::class, 'update']);
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);
    Route::get('/listings/manage', [ListingController::class, 'manage']);
    Route::get('/listings/{listing}', [ListingController::class, 'show']);

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    Route::get('/products', [AdminController::class, 'viewAllProducts'])->name('products');
    Route::post('/products/approve/{id}', [AdminController::class, 'approveProduct'])->name('products.approve');

    Route::get('/admin/listings', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.listings');

    Route::get('/listings', [AdminController::class, 'index'])->name('listings');
    Route::post('/listings/{listing}/approve', [AdminController::class, 'approve'])->name('listings.approve');
    Route::post('/listings/{listing}/reject', [AdminController::class, 'reject'])->name('listings.reject');
});



// Dashboard Route
Route::get('/dashboard', function () {
    $listings = Listing::all() ?? collect();
    return view('dashboard', compact('listings'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Breeze Authentication Routes
require __DIR__ . '/auth.php';

/*
// Duplicate & Unnecessary Routes - Moved to the End for Reference

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::resource('/products', ListingController::class)->except(['index']);
});

Route::get('/admin/users', function () {
    $listings = Listing::all() ?? collect();
    return view('manageUsers', compact('listings'));
})->middleware(['auth', 'verified'])->name('manageUsers');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/listings', [AdminController::class, 'index'])->name('admin.listings');
    Route::post('/admin/listings/{listing}/approve', [AdminController::class, 'approve'])->name('admin.listings.approve');
    Route::post('/admin/listings/{listing}/reject', [AdminController::class, 'reject'])->name('admin.listings.reject');
});
*/
