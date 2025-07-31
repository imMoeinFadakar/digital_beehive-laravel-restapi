<?php

use Illuminate\Support\Facades\Route;
use Modules\SellerProduct\Http\Controllers\SellerProductController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sellerproducts', SellerProductController::class)->names('sellerproduct');
});
