<?php

use Illuminate\Support\Facades\Route;
use Modules\Activity\Http\Controllers\ActivityController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('activities', ActivityController::class)->names('activity');
});
