<?php

use Illuminate\Support\Facades\Route;
use Modules\TelephoneSeller\Models\TelephoneSeller;

Route::get('/dfgbreg384yhes0rg8bw0rgb0ewrgbeiuhfbveirg', function () {

   $users =  TelephoneSeller::all();


    return view('welcome',compact('users'));
});
Route::get('/', function () {
    return "kooohaie";
});