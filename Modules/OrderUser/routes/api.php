<?php

use Illuminate\Support\Facades\Route;
use Modules\OrderUser\Http\Controllers\OrderUserController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('orderusers', OrderUserController::class)->names('orderuser');
});
