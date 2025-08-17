<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Http\Controllers\ForgetPasswordController;

Route::prefix("v1")->group(function () {
    
    Route::prefix("auth")->group(function () {

            Route::post('/login',[AuthController::class,'login']);
            Route::post('/register',[AuthController::class,'register']);
            Route::post("/validation-email",[AuthController::class,"verifiEmail"]);
            Route::post('/forget-password',[ForgetPasswordController::class, "forgetPassword"]);
            Route::post('/reset-password',[ForgetPasswordController::class, "resetPassword"]);
            Route::post("resend-vaerifi-email",[AuthController::class, "resendValidationCode"]);
            
            Route::middleware(['auth:sanctum'])->group(function () {
        
            Route::post('/logout',[AuthController::class,'logout']);
        
        });

    });
 

    


});
