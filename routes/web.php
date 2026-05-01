<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\SePayWebhookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CouponController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/store', [\App\Http\Controllers\StoreController::class, 'index'])->name('store.index');
Route::get('/products/{product}', [HomeController::class, 'show'])->name('products.show');
Route::get('/search-suggestions', [HomeController::class, 'searchSuggestions'])->name('search.suggestions');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/confirm/{order}', [CheckoutController::class, 'confirm'])->name('checkout.confirm');
Route::get('/order/status/{order}', [CheckoutController::class, 'getStatus'])->name('order.status');
Route::post('/order/clear-cart/{order}', [CheckoutController::class, 'clearCartAfterPayment'])->name('order.clear-cart');

// Coupon Routes
Route::post('/coupon/apply', [CouponController::class, 'apply'])->name('coupon.apply');
Route::post('/coupon/remove', [CouponController::class, 'remove'])->name('coupon.remove');

// SePay Webhook
Route::post('/sepay/webhook', [SePayWebhookController::class, 'handle'])->name('sepay.webhook');

// Order Tracking routes
Route::get('/order-tracking', [\App\Http\Controllers\OrderTrackingController::class, 'index'])->name('order.tracking');
Route::post('/order-tracking', [\App\Http\Controllers\OrderTrackingController::class, 'track'])->name('order.track');

// Custom Auth UI Routes (For Stitch Design)
Route::get('/login-custom', [CustomAuthController::class, 'login'])->name('custom.login');
Route::get('/forgot-password-custom', [CustomAuthController::class, 'forgotPassword'])->name('custom.forgot-password');

// Policy Pages
Route::view('/chinh-sach-bao-mat', 'policies.privacy')->name('policy.privacy');
Route::view('/quy-dinh-bao-hanh', 'policies.warranty')->name('policy.warranty');
Route::view('/chinh-sach-doi-tra', 'policies.return')->name('policy.return');
Route::view('/dieu-khoan-su-dung', 'policies.terms')->name('policy.terms');
Route::view('/chinh-sach-van-chuyen', 'policies.shipping')->name('policy.shipping');

// Profile Route (For Stitch Design)
Route::middleware('auth')->group(function () {
    Route::get('/my-profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::post('/my-profile/update', [UserProfileController::class, 'update'])->name('profile.update-info');
    Route::post('/my-profile/password', [UserProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::post('/my-profile/avatar', [UserProfileController::class, 'updateAvatar'])->name('profile.update-avatar');
    Route::get('/my-orders', [UserProfileController::class, 'orders'])->name('profile.orders');
    Route::get('/my-orders/{order}/json', [UserProfileController::class, 'orderDetail'])->name('profile.orders.detail');
    Route::put('/my-orders/{order}/update', [UserProfileController::class, 'updateOrder'])->name('profile.orders.update');
    Route::post('/my-orders/{order}/cancel', [UserProfileController::class, 'cancelOrder'])->name('profile.orders.cancel');
    Route::post('/my-orders/{order}/reorder', [UserProfileController::class, 'reorder'])->name('profile.orders.reorder');
    Route::get('/my-addresses', [UserProfileController::class, 'indexAddresses'])->name('profile.addresses');
    Route::post('/my-addresses', [UserProfileController::class, 'storeAddress'])->name('profile.address.store');
    Route::put('/my-addresses/{address}', [UserProfileController::class, 'updateAddress'])->name('profile.address.update');
    Route::delete('/my-addresses/{address}', [UserProfileController::class, 'deleteAddress'])->name('profile.address.delete');
    Route::get('/my-notifications', [UserProfileController::class, 'notifications'])->name('profile.notifications');
    Route::patch('/my-addresses/{address}/default', [UserProfileController::class, 'setDefaultAddress'])->name('profile.address.set-default');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Auth routes (Breeze)
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update']);
    Route::resource('customers', CustomerController::class)->only(['index', 'show', 'destroy']);
    Route::resource('brands', BrandController::class)->except(['show']);
    Route::resource('coupons', AdminCouponController::class)->except(['show']);
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

require __DIR__.'/auth.php';
