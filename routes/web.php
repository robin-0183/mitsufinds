<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DevAccessController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/coming-soon', [DevAccessController::class, 'showComingSoon'])->name('coming-soon');
Route::get('/dev-login', [DevAccessController::class, 'showDevLoginForm'])->name('dev-login');
Route::post('/dev-auth', [DevAccessController::class, 'authenticate'])->name('dev-auth');

Route::get('/', [ProductController::class, 'home'])->name('home');
Route::get('/products', [ProductController::class, 'publicIndex'])->name('products.index');
Route::get('/links', fn () => view('links'))->name('links');
Route::get('/trusted-sellers', fn () => view('trusted-sellers'))->name('trusted-sellers');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/dev-exit', [DevAccessController::class, 'exit'])->name('dev-exit');

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});
