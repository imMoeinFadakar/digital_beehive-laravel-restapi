<?php

use Illuminate\Support\Facades\Route;
use Modules\Refferal\Http\Controllers\RefferalController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('refferals', RefferalController::class)->names('refferal');
});
