<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Category\Models\Category;
use Modules\Category\Transformers\CategoryResource;
use Modules\Shared\Http\Controllers\SharedController;
use Modules\Shared\Traits\ApiResponseTrait;

/**
 * category of product
 */
class CategoryController extends Controller
{
    use ApiResponseTrait;
    /**
     * category/index
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
       $categories = Category::query()
       ->orderBy("id")
       ->get(['title','description']);

       return $this->api(CategoryResource::collection($categories),__METHOD__);

    }

    /**
     * category/show
     * @param \Modules\Category\Models\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        $category->load('product'); 

        return $this->api(new CategoryResource($category->toArray()),__METHOD__);
    }


 
}
