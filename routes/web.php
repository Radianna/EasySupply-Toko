<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('beranda');
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