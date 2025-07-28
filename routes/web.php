<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RazorpayPaymentController;
use Illuminate\Support\Facades\Route;

// HomeController Routes (Public)
Route::get('/', [HomeController::class, 'index']);
Route::get('mobile-cover', [HomeController::class, 'back_cover']);
Route::post('mobile-cover', [HomeController::class, 'mobile_cover']);
Route::get('details/{id}', [HomeController::class, 'cover_details']);
// Route::get('cover_details/{id}', [HomeController::class, 'back_cover_details']);
Route::get('snap-mobile-cover', [HomeController::class, 'snap_mobile_cover']);
Route::get('3d-neon-illustration-snap-case', [HomeController::class, 'neon_illustration_snap_case']);
Route::get('silicone-mobile-cover', [HomeController::class, 'silicone_mobile_cover']);
Route::get('3d-neon-illustration-soft-silicone-case', [HomeController::class, 'neon_illustration_soft_silicone_case']);
Route::get('glossy-metal-tpu-mobile-cover', [HomeController::class, 'glossy_metal_tpu_mobile_cover']);
Route::get('3d-neon-illustration-glossy-metal-tpu-case', [HomeController::class, 'neon_illustration_glossy_metal_tpu_case']);
Route::get('offer', [HomeController::class, 'offer']);
Route::get('contact', [HomeController::class, 'contact']);
Route::post('contact_form', [HomeController::class, 'contact_form']);
Route::get('/search', [HomeController::class, 'search']);
Route::post('search', [HomeController::class, 'search_cover']);

// AuthController Routes (Public)
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'add_user'])->name('register');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'auth_check'])->name('login');
Route::get('/activate-account', [AuthController::class, 'activateAccount'])->name('activate.account');
Route::get('forget-password', [HomeController::class, 'forget_password']);
Route::get('reset-password', [AuthController::class, 'showResetForm']);
Route::post('reset-password', [AuthController::class, 'reset_password'])->name('reset-password.submit');
Route::post('password-email', [AuthController::class, 'password_email'])->name('password-email');
Route::get('change-password', [AuthController::class, 'change_password']);
Route::post('update_password', [AuthController::class, 'update_password']);

// RazorpayPaymentController Routes
Route::get('payment', [RazorpayPaymentController::class, 'index']);
Route::post('payment', [RazorpayPaymentController::class, 'store']);

// Routes with auth middleware
Route::middleware(['auth'])->group(function () {
    // AdminController Routes (for authenticated users)
    Route::get('edit-profile', [AdminController::class, 'edit_profile']);
    Route::get('profile', [AdminController::class, 'profile']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('update_profile', [AdminController::class, 'update_profile']);
});

// Routes with auth and user middleware
Route::middleware(['auth', 'user'])->group(function () {
    // HomeController Routes (for users)
    Route::get('cart', [HomeController::class, 'cart']);
    Route::get('my_orders', [HomeController::class, 'my_orders']);
    Route::get('checkout', [HomeController::class, 'checkout']);
    Route::get('add-cart/{id}', [HomeController::class, 'add_cart']);
    Route::get('delete-cart/{id}', [HomeController::class, 'delete_cart']);
    Route::get('update-quantity', [HomeController::class, 'updateQuantity']);
    Route::post('apply-coupon', [HomeController::class, 'apply_coupon']);
    Route::post('add-address', [HomeController::class, 'add_address']);
    Route::get('cancel-order/{id}', [HomeController::class, 'cancel_order']);
});

// AdminController Routes with auth and admin middleware
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'index']);
    Route::get('add-mobile', [AdminController::class, 'mobile']);
    Route::post('add_mobile', [AdminController::class, 'add_mobile']);
    Route::get('delete_mobile/{id}', [AdminController::class, 'delete_mobile']);
    Route::get('manage-orders', [AdminController::class, 'manage_orders']);
    Route::post('store_cover', [AdminController::class, 'store_cover']);
    Route::get('add-case', [AdminController::class, 'case']);
    Route::post('store_case', [AdminController::class, 'store_case']);
    Route::get('view-cover', [AdminController::class, 'view_cover']);
    Route::get('edit-cover/{id}', [AdminController::class, 'edit_cover']);
    Route::get('delete_cover/{id}', [AdminController::class, 'delete_cover']);
    Route::post('update-case/{id}', [AdminController::class, 'update_case']);
    Route::get('users', [AdminController::class, 'users']);
    Route::get('delete_user/{id}', [AdminController::class, 'delete_user']);
    Route::get('confirm_order/{id}', [AdminController::class, 'confirm_order']);
    Route::get('cancel_order/{id}', [AdminController::class, 'cancel_order']);
    Route::get('delete_order/{id}', [AdminController::class, 'delete_order']);
    Route::get('ship_order/{id}', [AdminController::class, 'ship_order']);
    Route::get('deliver_order/{id}', [AdminController::class, 'deliver_order']);
    Route::get('manage-offer', [AdminController::class, 'manage_offer']);
    Route::post('store_offer', [AdminController::class, 'store_offer']);
    Route::get('edit-offer/{id}', [AdminController::class, 'edit_offer']);
    Route::post('update_offer/{id}', [AdminController::class, 'update_offer']);
    Route::get('delete_offer/{id}', [AdminController::class, 'delete_offer']);
    Route::get('message', [AdminController::class, 'message']);
    Route::get('delete-message/{id}', [AdminController::class, 'delete_message']);
});

// Error routes or any other routes can go here

