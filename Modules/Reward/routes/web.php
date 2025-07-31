<?php

use Illuminate\Support\Facades\Route;
use Modules\Reward\Http\Controllers\RewardController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('rewards', RewardController::class)->names('reward');
});
