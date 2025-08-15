<?php

use Modules\User\Models\User;
use Illuminate\Support\Facades\Route;
use Modules\Refferal\Models\Refferal;
use Modules\OrderUser\Models\OrderUser;
use App\Http\Controllers\ProfileController;
use Modules\Beehive\Models\Beehive;
use Modules\ProductUser\Models\ProductUser;
use Modules\TelephoneSeller\Models\TelephoneSeller;
use Modules\OrderUser\Http\Controllers\OrderUserController;
use Modules\Product\Models\Product;


// all sellers 
Route::get('/svndfbdfbpworgvjker0gjeggvodhvfdh', function () {


        $users =TelephoneSeller::all();


    return view('welcome',compact('users'));
});


// index orders
Route::get('/dfvhdsivdih9erhgdojgodbd',function(){


    $orders = OrderUser::all();

    return view("OrderUser",compact('orders'));
});

// update order
Route::get("/fdsdfvdfbvndifvnbdkfvdn/{userId}/{orderId}",function($userId,$orderId){

    $order = OrderUser::find($orderId);
    if(! $order)
        return redirect()->back();

    if($order->status == "done")
         return back()->with("error","سفارش قبلا تایید شده");
    

    $userBeehive = Beehive::where("user_id",$userId)->exists();

   if(! $userBeehive){
        Beehive::create(["user_id" => $userId]);
   } 

   $product = Product::find($order->product_id);

  $user =  User::find($userId);

   $user->score += $product->score * $order->quentity;
   $user->save();



    $order->status = "done";
    $order->save();

   return back()->with("success","سفارش با موفقیت تایید شد");

})->name('confirm');

// all user`s subset
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




Route::get('/dashboard',[ProfileController::class,"index"])
->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {

    Route::get("new_report/create/{referralCode}",[ProfileController::class,"createNewReport"])
    ->name("new.report.create");

      Route::post("new_report/store",[ProfileController::class,"storeNewReport"])
    ->name("new.report.store");


    Route::get("/userproduct/{id}",[OrderUserController::class,"getOrderUserByUserId"])
    ->name("user.product.get");

    Route::get("/getuserchart/{refferalCode}/{gen}",[ProfileController::class,"getUserByRefferalCode"])
    ->name("reffrals");


});

Route::get('/test-email', function () {
    \Illuminate\Support\Facades\Mail::raw('This is a test email', function ($message) {
        $message->to('moeinfadakar3@gmail.com')
                ->subject('Test Email from web');
    });
    return 'Sent';
});




require __DIR__.'/auth.php';
