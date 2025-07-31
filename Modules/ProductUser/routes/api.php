<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductUser\Http\Controllers\ProductUserController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('productusers', ProductUserController::class)->names('productuser');
});
