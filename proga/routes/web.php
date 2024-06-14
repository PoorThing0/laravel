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
    Route::post('/cart/destroy/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/updateQuantity/{id}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart.delete');
});
