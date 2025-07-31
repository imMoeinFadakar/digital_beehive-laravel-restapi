<?php

namespace Modules\ProductCode\Http\Controllers;

use Modules\ProductCode\Http\Requests\UpdateProductCode;
use Modules\ProductCode\Models\productCode;
use Modules\ProductCode\Transformers\productCodeResource;
use Modules\Shared\Http\Controllers\SharedController;

class ProductCodeController extends SharedController
{

    /**
     * Product Code / update
     * @param \Modules\ProductCode\Http\Requests\UpdateProductCode $request
     * @param \Modules\ProductCode\Models\productCode $productCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProductCode $request, productCode $productCode) {

        $productCode->updateProductCode($request->validated());

        return $this->api( new productCodeResource($productCode->toArray()) );
    }


}
