<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Models\Product;
use Modules\Product\Transformers\ProductResource;
use Modules\Shared\Http\Controllers\SharedController;

class ProductController extends SharedController
{
    /**
     * product/index
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $product = Product::query()
        ->when(isset($request->id), fn($query)=> $query->where("id",$request->id))
        ->when(isset($request->name), fn($query)=> $query->where("name","%". $request->name. "%")) 
        ->when(isset($request->slug), fn($query)=> $query->where("slug","%". $request->slug. "%")) 
        ->when(isset($request->price), fn($query)=> $query->where("price", $request->slug))
        ->with(['category:id,title,description'])
        ->get();

        return $this->api(ProductResource::collection($product),__METHOD__);
    
    }
    
    /**
     * product/show
     * @param \Modules\Product\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product,$slug)
    {

        dd($slug);

        $product->load(['category:id,title,description']);
        return $this->api(new ProductResource($product->toArray()),__METHOD__);

    }

}
