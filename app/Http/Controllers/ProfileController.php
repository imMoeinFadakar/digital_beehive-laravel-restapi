<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Modules\Auth\App\Models\SellerUser;

class ProfileController extends Controller
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
