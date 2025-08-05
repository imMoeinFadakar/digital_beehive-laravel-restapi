<?php

use Illuminate\Support\Facades\Route;
use Modules\Refferal\Http\Controllers\RefferalController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('refferals', RefferalController::class);

});
