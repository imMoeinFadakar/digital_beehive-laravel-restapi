<?php

use Illuminate\Support\Facades\Route;
use Modules\Sellers\Http\Controllers\SellersController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sellers', SellersController::class)->names('sellers');
});
