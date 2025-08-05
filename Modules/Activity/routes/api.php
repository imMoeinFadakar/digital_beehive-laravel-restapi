<?php

use Illuminate\Support\Facades\Route;
use Modules\Activity\Http\Controllers\ActivityController;
use Modules\Activity\Http\Controllers\ActivityUserController;

Route::prefix('v1')->group(function () {

        Route::middleware(['auth:sanctum'])->apiResource("activity_user", ActivityUserController::class)->only(["index","store"]);
        Route::apiResource("activity", ActivityController::class)->only(["index","show"]);
        
});




