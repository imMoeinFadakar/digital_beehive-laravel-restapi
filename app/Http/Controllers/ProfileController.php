<?php

namespace App\Http\Controllers;

use Modules\User\Models\User;
use Modules\Auth\Models\SellerUser;
use Illuminate\Support\Facades\Auth;
use Modules\Refferal\Models\Refferal;
use Modules\Shared\Http\Controllers\SharedController;

class ProfileController extends SharedController
{

    CONST REGISTER_URL = "https://honey-koohpayeh.vercel.app/login";
    public function index()
    {
        $sellerUser = $this->getSellerUserCostumers();

        $sellerRefferalCode = SELF::REGISTER_URL ."?code=" . auth()->user()->personel_code; 

        $gen = 0;

        return view("dashboard",compact("sellerUser",["sellerRefferalCode","gen"]));

    }


    public function getSellerUserCostumers()
    {
        return SellerUser::query()
        ->where("telephone_seller_id",Auth::id())
        ->with(['user:id,first_name,last_name,email,phone_number,refferal_code'])
        ->get();

    }

   

    public function getUserByRefferalCode(string $refferalCode,int $gen)
    {
        
        if($gen >= 4 )
            return redirect()->back(400)->with("error","اطلاعات مورد نظر پیدا نشد");

        $user = User::query()
        ->where("refferal_code",$refferalCode)
        ->where("status","active")
        ->first();

        $userRefferals = Refferal::query()
        ->where("reffering_id",$user->id)
        ->with(['reffered:id,first_name,phone_number,last_name,refferal_code'])
        ->get();


       $userRefferals->makeHidden(['reffering_id','reffered_id']);



        return view("GenerationRefferalPage",compact("userRefferals","gen"));


    }




}
