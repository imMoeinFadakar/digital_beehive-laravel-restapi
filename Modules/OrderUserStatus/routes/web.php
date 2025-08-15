<?php

use Illuminate\Support\Facades\Route;
use Modules\OrderUserStatus\Http\Controllers\OrderUserStatusController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('orderuserstatuses', OrderUserStatusController::class)->names('orderuserstatus');
});
