<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/categories', [CategoryController::class, 'index']);



Route::prefix('products')->controller(ProductController::class)->group(function() {
    Route::get('/', 'index');
    Route::get('/{slug}', 'show');
});
