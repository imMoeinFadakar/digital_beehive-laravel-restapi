<?php

use Modules\User\Models\User;
use Illuminate\Support\Facades\Route;
use Modules\Refferal\Models\Refferal;
use Modules\OrderUser\Models\OrderUser;
use App\Http\Controllers\ProfileController;
use Modules\ProductUser\Models\ProductUser;
use Modules\TelephoneSeller\Models\TelephoneSeller;
use Modules\OrderUser\Http\Controllers\OrderUserController;

Route::get('/svndfbdfbpworgvjker0gjeggvodhvfdh', function () {


        $users =TelephoneSeller::all();


    return view('welcome',compact('users'));
});



Route::get('/dfvhdsivdih9erhgdojgodbd',function(){


    $orders = OrderUser::all();

    return view("OrderUser",compact('orders'));
});


Route::get("/fdsdfvdfbvndifvnbdkfvdn?order={orderId}",function($orderId){

    $order = OrderUser::find($orderId);
    if(! $order)
        return redirect()->back();


    $order->status = "done";
    $order->save();

   return back()->with("success","سفارش با موفقیت تایید شد");

})->name('confirm');


Route::get('fnpdfnbodfbndfmvdpfvmdfvm/user/{userId}/referrals', function ($userId) {

    // متد کمکی برای گرفتن والد
    $getParentUserId = function ($userId) {
        return Refferal::where('reffered_id', $userId)->first()?->reffering_id;
    };

    // متد ساخت زنجیره ارجاع
    $getReferralChain = function ($userId) use ($getParentUserId) {
        $result = [];

        for ($i = 0; $i < 4; $i++) {
            $parentId = $getParentUserId($userId);

            if (! $parentId) {
                break;
            }

            $user = User::find($parentId, ['id', 'first_name', 'last_name', 'email']);

            if (! $user) {
                break;
            }

            $result[] = $user;
            $userId = $parentId;
        }

        return $result;
    };

    $referrals = $getReferralChain($userId);

    return view('Refferal_three', compact('referrals'));
})->name('parent');




Route::get('/dashboard',[ProfileController::class,"index"])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get("/userproduct/{id}",
    [OrderUserController::class,"getOrderUserByUserId"])
    ->name("user.product.get");

});

require __DIR__.'/auth.php';
