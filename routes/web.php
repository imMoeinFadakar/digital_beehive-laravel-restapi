<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Modules\OrderUser\Http\Controllers\OrderUserController;

Route::get('/svndfbdfbpworgvjker0gjeggvodhvfdh', function () {
    return view('welcome');
});

Route::get('/dashboard',[ProfileController::class,"index"])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get("/userproduct/{id}",
    [OrderUserController::class,"getOrderUserByUserId"])
    ->name("user.product.get");

});

require __DIR__.'/auth.php';
