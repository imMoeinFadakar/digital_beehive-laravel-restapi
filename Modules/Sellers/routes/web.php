<?php

use Illuminate\Support\Facades\Route;
use Modules\Sellers\Http\Controllers\SellersController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sellers', SellersController::class)->names('sellers');
});
