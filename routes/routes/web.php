<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/order', [UserController::class, 'order'])->name('user.order');
    Route::post('/add/{id}', [UserController::class, 'add'])->name('user.add');
    Route::get('/cart', [UserController::class, 'cart'])->name('user.cart');
    // Route xử lý checkout đơn hàng từ trang giỏ hàng (user)
    Route::post('/checkout', [UserController::class, 'checkout'])->name('user.checkout');

    // Route xóa sản phẩm khỏi giỏ hàng
    Route::get('/remove/{id}', [UserController::class, 'removeFromCart'])->name('user.remove');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');   // Xử lý đăng nhập (POST form)

    // Route cho Admin Dashboard (yêu cầu đã đăng nhập)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Route cho Admin Logout
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::get('/food', [FoodController::class, 'index'])->name('admin.food.index');
    Route::get('/food/create', [FoodController::class, 'create'])->name('admin.food.create');
    Route::post('/food/store', [FoodController::class, 'store'])->name('admin.food.store');
    Route::get('/food/{id}', [FoodController::class, 'show'])->name('admin.food.show');
    Route::get('/food/{id}/edit', [FoodController::class, 'edit'])->name('admin.food.edit');
    Route::put('/food/{id}', [FoodController::class, 'update'])->name('admin.food.update');
    Route::delete('/food/{id}', [FoodController::class, 'destroy'])->name('admin.food.destroy');

    Route::get('/order', [OrderController::class, 'index'])->name('admin.order.index');
    Route::get('/order/create', [OrderController::class, 'create'])->name('admin.order.create');
    Route::post('/order/store', [OrderController::class, 'store'])->name('admin.order.store');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('admin.order.show');
    Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('admin.order.edit');
    Route::put('/order/{id}', [OrderController::class, 'update'])->name('admin.order.update');
    Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('admin.order.destroy');

    Route::get('/user', [UserController::class, 'customer'])->name('admin.customer.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('admin.customer.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('admin.customer.store');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('admin.customer.show');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('admin.customer.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('admin.customer.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('admin.customer.destroy');
});
