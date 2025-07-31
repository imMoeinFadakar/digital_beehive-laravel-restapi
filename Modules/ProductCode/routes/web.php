<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductCode\Http\Controllers\ProductCodeController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('productcodes', ProductCodeController::class)->names('productcode');
});
