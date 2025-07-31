<?php

namespace Modules\TelephoneSeller\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Sellers\Http\Requests\StoreNewSellersRequest;
use Modules\Shared\Http\Controllers\SharedController;
use Modules\TelephoneSeller\Http\Requests\StoreNewTelephoneSeller;
use Modules\TelephoneSeller\Models\TelephoneSeller;
use Modules\TelephoneSeller\Transformers\TelephoneSellerResource;

class TelephoneSellerController extends SharedController
{
 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewTelephoneSeller $request,TelephoneSeller $telephoneSeller)
    {
      $image = $this->uploadMedia($request, "persenel", "image");

if (!$image) {
    return response()->json([
        'error' => 'آپلود تصویر انجام نشد. لطفاً بررسی کنید که فایل ارسال شده باشد.'
    ], 422);
}

$validated = $request->validated();
$validated['image'] = $image;

$telephoneSeller = $telephoneSeller->addNewTelephoneSeller($validated);

        return $this->api(new TelephoneSellerResource($telephoneSeller->toArray()),__METHOD__);
    }


}
