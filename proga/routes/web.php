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

Route::get('/catalog', [CatalogController::class, 'index']);

use App\Http\Controllers\CartController;

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');