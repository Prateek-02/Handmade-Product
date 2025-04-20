<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\OrderController as BuyerOrderController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\RoleMiddleware;

// 🔐 Auth Routes
require __DIR__ . '/auth.php';

// 🏠 Home Page
Route::get('/', fn () => view('welcome'));

// ✅ Fallback dashboard route (required by Breeze/Fortify)
Route::get('/dashboard', function () {
    return redirect()->route('redirect-dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🚦 Dynamic Dashboard Redirect Based on Role
Route::get('/redirect-dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'seller') {
        return redirect()->route('seller.dashboard');
    } elseif ($user->role === 'buyer') {
        return redirect()->route('buyer.home');
    } else {
        abort(403, 'Unauthorized');
    }
})->middleware(['auth'])->name('redirect-dashboard');

// 👤 Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🧑 Buyer Routes
Route::middleware(['auth', RoleMiddleware::class . ':buyer'])->prefix('buyer')->group(function () {
    Route::get('/home', [BuyerController::class, 'home'])->name('buyer.home');
    Route::get('/dashboard', [BuyerController::class, 'dashboard'])->name('buyer.dashboard');
    Route::get('/products', [BuyerController::class, 'products'])->name('buyer.products');

    // ✅ Individual Product Order Flow
    Route::get('/products/{product}/order', [BuyerOrderController::class, 'orderForm'])->name('buyer.order.form');
    Route::get('/products/{product}/address', [BuyerOrderController::class, 'addressForm'])->name('buyer.order.address');
    Route::post('/products/{product}/place', [BuyerOrderController::class, 'placeOrder'])->name('buyer.order.place');
    Route::get('/orders', [BuyerOrderController::class, 'myOrders'])->name('buyer.orders');
    Route::get('/order/confirmation/{order}', [BuyerOrderController::class, 'confirmation'])->name('buyer.order.confirmation');

    // 💖 Wishlist
    Route::get('/wishlist', [\App\Http\Controllers\Buyer\WishlistController::class, 'index'])->name('buyer.wishlist');
    Route::post('/wishlist/{product}', [\App\Http\Controllers\Buyer\WishlistController::class, 'toggle'])->name('buyer.wishlist.toggle');

    // 🛒 Cart
    Route::get('/cart', [\App\Http\Controllers\Buyer\CartController::class, 'index'])->name('buyer.cart');
    Route::post('/cart/add/{product}', [\App\Http\Controllers\Buyer\CartController::class, 'add'])->name('buyer.cart.add');
    Route::delete('/cart/remove/{cart}', [\App\Http\Controllers\Buyer\CartController::class, 'remove'])->name('buyer.cart.remove');

    // 🛒 Cart Checkout
    Route::get('/cart/address', [\App\Http\Controllers\Buyer\CartController::class, 'addressForm'])->name('buyer.cart.address');
    Route::post('/cart/place', [\App\Http\Controllers\Buyer\CartController::class, 'placeOrder'])->name('buyer.cart.place');
});

// 🧑‍🎨 Seller Routes
Route::middleware(['auth', RoleMiddleware::class . ':seller'])->prefix('seller')->group(function () {
    Route::get('/dashboard', fn () => view('seller.dashboard'))->name('seller.dashboard');

    // 🛍️ Product Routes
    Route::get('/products', [ProductController::class, 'index'])->name('seller.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('seller.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('seller.products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('seller.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('seller.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('seller.products.destroy');

    // 📦 Order Management
    Route::get('/orders', [SellerOrderController::class, 'index'])->name('seller.orders');
    Route::put('/orders/{order}', [SellerOrderController::class, 'update'])->name('seller.orders.update');
});

// 📄 Static Footer Pages
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

// 🚪 Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
