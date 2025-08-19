<?php

use Illuminate\Support\Facades\Route;
use Modules\AuthOtp\Http\Controllers\AuthOtpController;
use Modules\AuthOtpSms\Http\Controllers\AuthOtpSmsController;
use Modules\AuthOtpSms\Http\Controllers\OtpAuthController;
use Modules\AuthOtpSms\Models\OtpAuth;

Route::prefix('v1')->group(function () {

    Route::prefix("/otp")->group(function(){

        Route::post("/send",[OtpAuthController::class, "sendOtpCode"]);
        Route::post("/verify",[OtpAuthController::class,"verifiOtpCode"]);
        Route::post("/resend",[OtpAuthController::class,"resendOtpCode"]);



    });


});
