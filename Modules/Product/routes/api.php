<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;

Route::prefix('v1')->group(function () {
    Route::apiResource("product",ProductController::class);
});
