<?php

use Illuminate\Support\Facades\Route;
use Modules\SellerUser\Http\Controllers\SellerUserController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sellerusers', SellerUserController::class)->names('selleruser');
});
