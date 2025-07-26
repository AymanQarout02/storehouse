<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/products/my_products', [ProductController::class, 'myProducts'])
        ->name('products.my_products');
    Route::resource('products', ProductController::class);

    Route::resource('users', UserController::class);

    Route::resource('categories', CategoryController::class);
});



Route::middleware(['auth', 'role:admin,manager'])->group(function () {
    Route::resource('products', ProductController::class)->except(['index', 'show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});




require __DIR__ . '/auth.php';
