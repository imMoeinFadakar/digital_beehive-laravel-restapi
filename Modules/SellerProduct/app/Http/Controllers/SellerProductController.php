<?php

namespace Modules\SellerProduct\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Sellers\Models\Seller;
use App\Http\Controllers\Controller;
use Modules\ProductCode\Models\productCode;
use Modules\SellerProduct\Models\SellerProduct;
use Modules\Shared\Http\Controllers\SharedController;
use Modules\SellerProduct\Http\Requests\SellerProductRequest;
use Modules\SellerProduct\Transformers\SellerProductResource;

class SellerProductController extends SharedController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seller = auth()->user()->seller;
        $sellerProduct  = SellerProduct::query()
        ->where("seller_id", $seller->id)
        ->with(["product_code.product","seller.user"])
        ->get();


        return $this->api(SellerProductResource::collection($sellerProduct),__METHOD__);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SellerProductRequest $request,SellerProduct $sellerProduct) {
        
        $validated = $request->validated();
        
        $productCode =  $this->findSoliedProductCode($validated["product_code"]);
       
        $seller = $this->findSeller($validated["seller_code"]);
        
         if(! $productCode || ! $seller)
            return $this->api(null,__METHOD__,
        "The selected product code or seller code is invalid");
        
        $attrebuites = $this->databaseArray(['seller_id','product_code_id','commission'],
        [$seller->id,$productCode->id,$productCode->commission]);
        
        $this->changeProductStatus($productCode);

        $this->increaseSellerCommission($seller, $productCode->commission);

        $sellerProduct =  $sellerProduct->addNewSellerProduct($attrebuites);

        $sellerProduct->load(['product_code','seller']);

        return $this->api(new SellerProductResource($sellerProduct->toArray()),
        __METHOD__);

    }

    protected function increaseSellerCommission(Seller $seller,int  $commission): ?int {
        
        return $seller->increment("total_commission", $commission);
    }

    protected function changeProductStatus(ProductCode $productCode)
    {
        $productCode->status = "used";
        $productCode->save();
        return;
    }

    public function findSeller(int $sellerCode): Seller|null
    {
        return Seller::query()
        ->where("seller_code", $sellerCode)
        ->first();

    }

     public function findSoliedProductCode(int $productCode): productCode|null
     {
            return productCode::query()
            ->where("code" , $productCode)
            ->where("status","not_used")
            ->with(['product'])
            ->first();
     }



    // protected function findEntities(string $table, string $coulmn,
    //  int|string|array $value)
    // {
    //     if(gettype($value) === "array") {

    //          return DB::table($table)
    //         ->whereIn($coulmn,$value)
    //         ->first();
    //     }

    //     return DB::table($table)
    //     ->where($coulmn,$value)
    //     ->first();
    // }
 
}
