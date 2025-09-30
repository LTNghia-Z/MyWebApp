<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\productsController;
use App\Models\products;

Route::get('/', function () {
    $products = Products::all();   // lấy tất cả sản phẩm
    return view('home', compact('products')); // truyền xuống view
});
Route::post('/register',[UserController::class,'register']);

Route::post('/create-products',[productsController::class,'createProducts']);
Route::delete('/delete-products/{id}',[productsController::class,'destroy']);
Route::get('/edit-products/{id}',[productsController::class,'editProducts']);
Route::put('/edit-products/{id}',[productsController::class,'updateProducts']);

