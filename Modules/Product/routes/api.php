<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::get('product-index', [ProductController::class,"index"]);
    Route::get('product/{slug}', [ProductController::class,"show"]);

});
