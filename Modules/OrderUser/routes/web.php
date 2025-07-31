<?php

use Illuminate\Support\Facades\Route;
use Modules\OrderUser\Http\Controllers\OrderUserController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('orderusers', OrderUserController::class)->names('orderuser');
});
