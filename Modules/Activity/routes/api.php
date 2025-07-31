<?php

use Illuminate\Support\Facades\Route;
use Modules\Activity\Http\Controllers\ActivityController;
use Modules\Activity\Http\Controllers\ActivityUserController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {

        Route::apiResource("activity_user", ActivityUserController::class)->only(["index","store"]);
        
});

Route::apiResource("activity", ActivityController::class)->only(["index","show"]);



