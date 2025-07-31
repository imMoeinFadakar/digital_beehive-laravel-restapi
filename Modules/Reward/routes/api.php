<?php

use Illuminate\Support\Facades\Route;
use Modules\Reward\Http\Controllers\RewardController;
use Modules\Reward\Http\Controllers\RewardUserController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('rewards', RewardController::class)->names('reward');
    Route::apiResource('reward_user', RewardUserController::class)->names('reward');

});
