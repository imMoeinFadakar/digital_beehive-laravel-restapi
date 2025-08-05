<?php

namespace Modules\ProductUser\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\ProductCode\Models\productCode;
use Modules\ProductUser\Models\ProductUser;
use Modules\Shared\Http\Controllers\SharedController;
use Modules\ProductUser\Transformers\ProductUserResource;
use Modules\ProductUser\Http\Requests\storeNewProductUserRequest;

class ProductUserController extends SharedController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = ProductUser::query()
        ->where("user_id",auth()->user()->id)
        ->with(['product'])
        ->get();

        return $this->api(new ProductUserResource($product->toArray()),__METHOD__);
    }

  



    /**
     * Store a newly created resource in storage.
     */
    public function store(storeNewProductUserRequest $request,ProductUser $productUser) {

        $productCode = $this->findProduct($request);

        if(! $productCode)
            return $this->api(null,__METHOD__,"product not found!");
 
        try{

            DB::beginTransaction();

            $validated = $request->validated();

            $productCode->status = "used";
            $productCode->save();

           $data =  $this->databaseArray(
            ['user_id','product_id','product_code_id'],
            [auth()->user()->id,$validated['product_id'],$productCode->id]);

            auth()->user()->increment("score",$productCode->score);

           $productUser =  $productUser->addNewProductUser($data);

            DB::commit();

            return $this->api(new ProductUserResource($productUser->toArray()),
            __METHOD__);

        }catch(Exception $e){

            DB::rollBack();

                 return $this->api(null,
            __METHOD__,"Unknown error occurred!" . $e->getMessage());

        }

    }

    public function findProduct($request): ?productCode
    {
        return productCode::query()
        ->where("code", $request->code)
        ->where("product_id", $request->product_id)
        ->where("status","not_used")
        ->first();
    }





 

}
