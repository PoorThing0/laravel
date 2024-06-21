<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/catalog', function () {
    return view('catalog');
});

Route::get('/cart', function () {
    return view('cart');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


use App\Http\Controllers\CatalogController;

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');


use App\Http\Controllers\CartController;


Route::middleware(['auth'])->group(function () {

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
Route::post('/cart/apply-promo', [CartController::class, 'applyPromoCode'])->name('cart.apply-promo');

});

use App\Http\Controllers\Admin\AdminController;

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::delete('promo-codes/{id}', [AdminController::class, 'destroy'])->name('admin.promo-codes.destroy');
Route::patch('promo-codes/{id}/toggle', [AdminController::class, 'toggleActivation'])->name('admin.promo-codes.toggle');
Route::post('promo-codes', [AdminController::class, 'store'])->name('admin.promo-codes.store');

Route::get('admin/products', [AdminController::class, 'products'])->name('admin.products');
Route::delete('products/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');
Route::get('admin/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
Route::post('admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');


use App\Http\Controllers\OrderController;

Route::get('/checkout', [OrderController::class, 'showCheckoutPage'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('order.show');


use App\Http\Controllers\UserProfileController;

Route::get('/profile', [UserProfileController::class, 'profile'])->name('profile');


use App\Http\Controllers\Admin\AdminOrderController;

Route::get('admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
Route::put('admin/orders/{id}', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');



use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

Route::get('/test-email', function () {
    Mail::to('nazarets2005@yandex.ru')->send(new TestEmail());
    return 'Test email sent';
});

use App\Http\Controllers\SlideController;

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::resource('slides', SlideController::class)->except(['show', 'edit', 'update']);
});
Route::get('/', [SlideController::class, 'indexhome'])->name('home');


use App\Http\Controllers\Courier\CourierAuthController;
use App\Http\Controllers\Courier\CourierOrderController;

Route::prefix('courier')->name('courier.')->group(function () {
    Route::get('register', [CourierAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [CourierAuthController::class, 'register']);
    Route::get('login', [CourierAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [CourierAuthController::class, 'login']);
    Route::post('logout', [CourierAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:courier')->group(function () {
        Route::get('orders', [CourierOrderController::class, 'index'])->name('orders');
        Route::put('orders/{order}/delivered', [CourierOrderController::class, 'markAsDelivered'])->name('orders.delivered');
    });
});




