<?php

use Illuminate\Support\Facades\Route;
use Modules\Beehive\Http\Controllers\BeehiveController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('beehives', BeehiveController::class)->names('beehive');
});
