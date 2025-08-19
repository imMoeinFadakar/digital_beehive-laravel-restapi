<?php

namespace Modules\OrderUserStatus\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddNewReportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\OrderUserStatus\Http\Requests\AddNewOrderUserStatus;
use Modules\OrderUserStatus\Models\OrderUserstatus;
use Modules\TelephoneSeller\Models\TelephoneSeller;

class OrderUserStatusController extends Controller
{
   
    public function store(AddNewOrderUserStatus $request,OrderUserstatus $orderUserstatus)
    {
        $validated = $request->validated();

        $seller = $this->findTelephoneSeller($validated['seller_code']);
       $sellerUser =  $orderUserstatus->addNewOrderUserStatus([
            "telephone_seller_id" => $seller->id,
            "user_id" => Auth::id()
        ]);

        return $this->api($seller)

    }

    protected function findTelephoneSeller($sellerCode)
    {
        return TelephoneSeller::query()
        ->where("personel_code",$sellerCode)
        ->first();
    }

}
