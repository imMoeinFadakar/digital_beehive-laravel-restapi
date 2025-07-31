<?php

use Illuminate\Support\Facades\Route;
use Modules\TelephoneSeller\Http\Controllers\TelephoneSellerController;

Route::prefix('v1')->group(function () {
    Route::apiResource('telephone_sellers', TelephoneSellerController::class)->names('telephoneseller');
});
