<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ProductController::class, 'index']); // Trang chủ → danh sách sản phẩm
Route::resource('products', ProductController::class);

