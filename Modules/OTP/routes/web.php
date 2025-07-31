<?php

use Illuminate\Support\Facades\Route;
use Modules\OTP\Http\Controllers\OTPController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('otps', OTPController::class)->names('otp');
});
