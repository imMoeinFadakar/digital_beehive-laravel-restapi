<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::prefix('v1')->group(function () {

    Route::middleware(['auth:sanctum'])
    ->apiResource('users', UserController::class);

   
});


