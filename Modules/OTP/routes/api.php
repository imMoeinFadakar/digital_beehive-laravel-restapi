<?php

use Illuminate\Support\Facades\Route;
use Modules\OTP\Http\Controllers\OTPController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('otps', OTPController::class)->names('otp');
});
