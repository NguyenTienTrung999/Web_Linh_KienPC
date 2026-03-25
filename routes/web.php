<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/store', [\App\Http\Controllers\StoreController::class, 'index'])->name('store.index');
Route::get('/products/{product}', [HomeController::class, 'show'])->name('products.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::get('/checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');

// Custom Auth UI Routes (For Stitch Design)
Route::get('/login-custom', [CustomAuthController::class, 'login'])->name('custom.login');
Route::get('/forgot-password-custom', [CustomAuthController::class, 'forgotPassword'])->name('custom.forgot-password');

// Profile Route (For Stitch Design)
Route::get('/my-profile', [\App\Http\Controllers\UserProfileController::class, 'index'])->name('profile.index');



// Auth routes (Breeze)
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show']);
});

require __DIR__.'/auth.php';
