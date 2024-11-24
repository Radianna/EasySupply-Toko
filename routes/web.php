<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('beranda', function () {
    return view('beranda');
});
Route::get('list-produk', function () {
    return view('listProduk');
});

Route::get('detail-pesanan', function () {
    return view('detailpesanan');
});


Route::post('addToCart', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('getCart', [CartController::class, 'getCart'])->name('getCart');
Route::post('removeFromCart', [CartController::class, 'removeFromCart'])->name('removeFromCart');
Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');