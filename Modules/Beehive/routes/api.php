<?php

use Illuminate\Support\Facades\Route;
use Modules\Beehive\Http\Controllers\BeehiveController;


Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {

    Route::apiResource("beehive",BeehiveController::class);

});
