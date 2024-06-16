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


