<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductUser\Http\Controllers\ProductUserController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('productusers', ProductUserController::class)->names('productuser');
});
