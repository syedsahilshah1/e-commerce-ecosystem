<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProviderController;

// ...

// Customer Routes
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');
    Route::post('/order/return/{id}', [CustomerController::class, 'requestReturn'])->name('order.return');
});

// Main Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/shipping', [HomeController::class, 'shipping'])->name('shipping');
Route::get('/help-center', [HomeController::class, 'helpCenter'])->name('helpCenter');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Products
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Checkout
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/checkout/place', [OrderController::class, 'placeOrder'])->name('checkout.place');

// Auth
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
});

// Admin Routes
Route::middleware(['auth', \App\Http\Middleware\EnsureAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/provider/approve/{id}', [AdminController::class, 'approveProvider'])->name('approve');
    Route::post('/provider/reject/{id}', [AdminController::class, 'rejectProvider'])->name('reject');
    Route::post('/product/toggle-sunday-sale/{id}', [AdminController::class, 'toggleSundaySale'])->name('toggleSundaySale');
});

// Provider Routes
Route::middleware(['auth', \App\Http\Middleware\EnsureProvider::class])->prefix('provider')->name('provider.')->group(function () {
    Route::get('/dashboard', [ProviderController::class, 'index'])->name('dashboard');
    Route::get('/products/create', [ProviderController::class, 'create'])->name('products.create');
    Route::post('/products', [ProviderController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProviderController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProviderController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProviderController::class, 'destroy'])->name('products.destroy');
    Route::post('/orders/{id}/status', [ProviderController::class, 'updateOrderStatus'])->name('orders.updateStatus');
    Route::post('/orders/{id}/return-status', [ProviderController::class, 'updateReturnStatus'])->name('orders.updateReturnStatus');
});
