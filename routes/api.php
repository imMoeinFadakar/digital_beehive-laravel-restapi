<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/health', fn () => response()->json(['status' => 'ok']));

Route::prefix("v1")->group(function () {
    
    Route::prefix("auth")->group(function () {

            Route::post('/login',[AuthController::class,'login']);
            Route::post('/register',[AuthController::class,'register']);

        Route::middleware(['auth:sanctum'])->group(function () {
        
            Route::post('/logout',[AuthController::class,'logout']);
        
        });

    });
 

    


});

