<?php

use Illuminate\Support\Facades\Route;
use Modules\Activities\Http\Controllers\ActivityController;
use Modules\Activities\Http\Controllers\ActivityUserController;

Route::prefix('v1')->group(function () {

    Route::middleware(["auth:sanctum"])->group(function(){
        Route::apiResource("user_activity",ActivityUserController::class);

    });
    Route::apiResource('activities', ActivityController::class)->names('activities');
});
