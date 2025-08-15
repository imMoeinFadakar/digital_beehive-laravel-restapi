<?php

use Illuminate\Support\Facades\Route;
use Modules\OrderUserStatus\Http\Controllers\OrderUserStatusController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('orderuserstatuses', OrderUserStatusController::class)->names('orderuserstatus');
});
