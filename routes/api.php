<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;

Route::prefix('products')->controller(ProductController::class)->group(function() {
    Route::get('/', 'index');
    Route::get('/{slug}', 'show');
});

Route::prefix('categories')->controller(CategoryController::class)->group(function() {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
});

Route::prefix('reviews')->controller(ReviewController::class)->group(function (){
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
Route::get('/user', [AuthController::class, 'user']);

Route::get('/cart', [CartController::class, 'index']);

Route::post('/cart-items', [CartItemController::class, 'store']);


});
