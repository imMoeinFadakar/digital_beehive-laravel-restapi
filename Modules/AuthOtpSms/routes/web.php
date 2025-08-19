<?php

use Illuminate\Support\Facades\Route;
use Modules\AuthOtpSms\Http\Controllers\AuthOtpSmsController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('authotpsms', AuthOtpSmsController::class)->names('authotpsms');
});
