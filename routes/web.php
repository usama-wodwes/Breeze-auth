<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;



// Home Page - Redirect to Listings
Route::get('/', function () {
    return redirect('/listings');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/listings', [ListingController::class, 'index']);
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/users', [AdminController::class, 'manageUsers']);
    Route::get('/admin/products', [AdminController::class, 'viewAllProducts']);
    Route::post('/admin/products/approve/{id}', [AdminController::class, 'approveProduct']);
});

// User Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::resource('/products', ListingController::class)->except(['index']);
});

Route::get('/', [ListingController::class, 'index'])->name('listings.index');
// All Listing Routes (Only for Authenticated Users)
Route::middleware('auth')->group(function () {
    // Show all listings
    // Route::get('/listings', [ListingController::class, 'index']);


    // Show create form
    Route::get('/listings/create', [ListingController::class, 'create']);

    // Store new listing
    Route::post('/listings', [ListingController::class, 'store']);

    // Show edit form
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

    // Update listing
    Route::put('/listings/{listing}', [ListingController::class, 'update']);

    // Delete listing
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);

    // Manage listings
    Route::get('/listings/manage', [ListingController::class, 'manage']);

    // Show single listing
    Route::get('/listings/{listing}', [ListingController::class, 'show']);
});


// Dashboard route (only for authenticated users)
Route::get('/dashboard', function () {
    $listings = Listing::all() ?? collect();
    return view('dashboard', compact('listings'));
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/admin/users', function () {
    $listings = Listing::all() ?? collect();
    return view('manageUsers', compact('listings'));
})->middleware(['auth', 'verified'])->name('manageUsers');
// Route::get('/admin/users', [AdminController::class, 'manageUsers']);

// Breeze Authentication Routes
require __DIR__ . '/auth.php';

// Profile Routes (Only for Authenticated Users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
//     Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
//     Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
//     Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
//     Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
//     Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
// });
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('users');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/products', [AdminController::class, 'viewAllProducts'])->name('products');
    Route::post('/products/approve/{id}', [AdminController::class, 'approveProduct'])->name('products.approve');

    Route::get('/listings', [AdminController::class, 'index'])->name('listings');
    Route::post('/listings/{listing}/approve', [AdminController::class, 'approve'])->name('listings.approve');
    Route::post('/listings/{listing}/reject', [AdminController::class, 'reject'])->name('listings.reject');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/listings', [AdminController::class, 'index'])->name('admin.listings');
    Route::post('/admin/listings/{listing}/approve', [AdminController::class, 'approve'])->name('admin.listings.approve');
    Route::post('/admin/listings/{listing}/reject', [AdminController::class, 'reject'])->name('admin.listings.reject');
});
