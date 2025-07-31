<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductCode\Http\Controllers\ProductCodeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('productcodes', ProductCodeController::class)->names('productcode');
});
