<?php

use Illuminate\Support\Facades\Route;
use Modules\Otp\Http\Controllers\OtpController;

Route::prefix('v1')->group(function () {
    Route::post('send_otp', [OtpController::class,"sendOtp"]);
    Route::post('verifi_otp', [OtpController::class,"verifiOtp"]);
});
