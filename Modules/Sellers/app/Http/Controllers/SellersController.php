<?php

namespace Modules\Sellers\Http\Controllers;

use Illuminate\Http\Request;
use Modules\ProductUser\Models\ProductUser;
use Modules\Sellers\Models\Seller;
use Modules\Sellers\Transformers\SellersResource;
use Modules\Shared\Http\Controllers\SharedController;

class SellersController extends SharedController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $sellerProfile = Seller::query()
       ->where("user_id", auth()->user()->id)
       ->first();

        return $this->api(new SellersResource($sellerProfile),__METHOD__);
    }

 

    /**
     * Store a newly created resource in storage.
     */
    public function store(request $request, Seller $seller) {

        if(! $this->findUserProduct())
            return $this->api(null,__METHOD__,
        "you want to be a seller! buy one of our product for start");

        if($this->isUserSeller())
            return $this->api(null,__METHOD__,
        "you already a seller");


        $seller = $seller->addNewSeller();

        return $this->api(new SellersResource($seller->toArray()),
        __METHOD__);

    }

    protected function isUserSeller(): ?bool
    {
        return Seller::query()
        ->where("user_id", auth()->user()->id)
        ->exists();
    }

    protected function findUserProduct(): ?bool
    {
        return ProductUser::query()
        ->where("user_id", auth()->user()->id)
        ->exists();
    }


}
