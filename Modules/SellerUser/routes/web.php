<?php

use Illuminate\Support\Facades\Route;
use Modules\SellerUser\Http\Controllers\SellerUserController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sellerusers', SellerUserController::class)->names('selleruser');
});
