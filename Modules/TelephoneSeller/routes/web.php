<?php

use Illuminate\Support\Facades\Route;
use Modules\TelephoneSeller\Http\Controllers\TelephoneSellerController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('telephonesellers', TelephoneSellerController::class)->names('telephoneseller');
});
