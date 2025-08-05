<?php

use Illuminate\Support\Facades\Route;
use Modules\Otp\Http\Controllers\OtpController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('otps', OtpController::class)->names('otp');
});
