<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;

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
