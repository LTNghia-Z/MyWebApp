<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\FoodApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\UserApiController;

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/register', [AuthApiController::class, 'register']);


    Route::get('/user', [UserApiController::class, 'profile']);
    Route::post('/logout', [AuthApiController::class, 'logout']);

    Route::get('/foods', [FoodApiController::class, 'index']);
    Route::post('/foods', [FoodApiController::class, 'store']);
    Route::get('/foods/{id}', [FoodApiController::class, 'show']);
    Route::put('/foods/{id}', [FoodApiController::class, 'update']);
    Route::delete('/foods/{id}', [FoodApiController::class, 'destroy']);

    Route::get('/orders', [OrderApiController::class, 'index']);
    Route::post('/orders', [OrderApiController::class, 'store']);
    Route::get('/orders/{id}', [OrderApiController::class, 'show']);

