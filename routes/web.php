<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DevAccessController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TiktokVideoController;
use App\Models\Product;
use App\Models\TiktokVideo;
use Illuminate\Support\Facades\Route;

Route::get('/dev-login', [DevAccessController::class, 'showDevLoginForm'])->name('dev-login');
Route::post('/dev-auth', [DevAccessController::class, 'authenticate'])->name('dev-auth');

Route::get('/', [ProductController::class, 'home'])->name('home');
Route::get('/products', [ProductController::class, 'publicIndex'])->name('products.index');
Route::get('/links', fn () => view('links'))->name('links');
Route::get('/trusted-sellers', fn () => view('trusted-sellers'))->name('trusted-sellers');
Route::get('/faq', fn () => view('faq'))->name('faq');
Route::get('/dmca-privacy', fn () => view('dmca-privacy'))->name('dmca-privacy');
Route::get('/tiktoks', function () {
    $videos = TiktokVideo::query()
        ->where('is_active', true)
        ->orderByDesc('sort_order')
        ->latest()
        ->get();

    return view('tiktoks', ['videos' => $videos]);
})->name('tiktoks');
Route::get('/favorites', function () {
    $products = Product::query()
        ->where('is_active', true)
        ->latest()
        ->get();

    return view('favorites', ['products' => $products]);
})->name('favorites');

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

    Route::get('/tiktoks', [TiktokVideoController::class, 'index'])->name('admin.tiktoks.index');
    Route::get('/tiktoks/create', [TiktokVideoController::class, 'create'])->name('admin.tiktoks.create');
    Route::post('/tiktoks', [TiktokVideoController::class, 'store'])->name('admin.tiktoks.store');
    Route::delete('/tiktoks/{tiktokVideo}', [TiktokVideoController::class, 'destroy'])->name('admin.tiktoks.destroy');
});
