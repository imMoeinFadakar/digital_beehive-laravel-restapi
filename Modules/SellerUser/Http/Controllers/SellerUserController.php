<?php

namespace Modules\SellerUser\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\SellerUser\Transformers\SellerUserResource;
use Modules\Shared\Traits\ApiResponseTrait;
use Modules\TelephoneSeller\Models\TelephoneSeller;
use Modules\SellerUser\Http\Requests\SellerUserRequest;
use Modules\SellerUser\Models\SellerUser;

class SellerUserController extends Controller
{   
    use ApiResponseTrait;
   
    public function index()
    {
        $sellerUser = $this->getSellerUser();
        if(! $sellerUser)
            return $this->api(["url" => config("app.frontend_url") 
        . "/login?" . "user=" . Auth::user()->refferal_code ],__METHOD__);

       
           return $this->api(["url" => config("app.frontend_url") 
        . "/login?". "code=". $sellerUser->seller->personel_code  . "&user=" . Auth::user()->refferal_code ],__METHOD__);



    }


    protected function getSellerUser(): SellerUser|null
    {
        return SellerUser::query()
        ->where("user_id",Auth::id())
        ->with(['seller:id,personel_code'])
        ->first();
    }





    public function store(SellerUserRequest $request,SellerUser $sellerUser)
    {
        $validated = $request->validated();

        //find telephone seller
        $seller = $this->findTelephoneSeller($validated['seller_code']);

        // is this user invented before
        if($this->isSellerUseExists())
            return $this->api(null,__METHOD__,
        "این شخص قبلا با کد معرفی دیگری ثبت نام شده",false,400);

        // craeet new seller user
         $sellerUser->addNewSellerUser([
            "telephone_seller_id" => $seller->id,
            "user_id" => Auth::id()
        ]);

        // response
        return $this->api(null,__METHOD__,"دعوت موفقیت امیز بود");
    }

    protected function findTelephoneSeller($sellerCode)
    {
        return TelephoneSeller::query()
        ->where("personel_code",$sellerCode)
        ->first();
    }

    public function isSellerUseExists(): ?bool
    {
        return SellerUser::query()
        ->where("user_id",Auth::id())
        ->exists();
    }
   


}
