<?php

namespace App\Http\Controllers;

use Modules\Auth\Models\SellerUser;
use Illuminate\Support\Facades\Auth;
use Modules\Shared\Http\Controllers\SharedController;

class ProfileController extends SharedController
{
    public function index()
    {
        $sellerUser = $this->getSellerUserCostumers();



        return view("dashboard",compact("sellerUser"));

    }


    public function getSellerUserCostumers()
    {
        return SellerUser::query()
        ->where("telephone_seller_id",Auth::id())
        ->with(['user:id,first_name,last_name,email,phone_number'])
        ->get();

    }

   

  




}
