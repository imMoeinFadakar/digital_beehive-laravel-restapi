<?php

use Illuminate\Support\Facades\Route;
use Modules\Activities\Http\Controllers\ActivitiesController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('activities', ActivitiesController::class)->names('activities');
});
