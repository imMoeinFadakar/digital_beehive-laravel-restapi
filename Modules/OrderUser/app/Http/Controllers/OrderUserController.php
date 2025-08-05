<?php

namespace Modules\OrderUser\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Modules\OrderUser\Models\OrderUser;
use Modules\OrderUser\Transformers\OrderUserResource;
use Modules\Shared\Http\Controllers\SharedController;
use Modules\OrderUser\Http\Requests\UpdateOrderUserRequest;
use Modules\OrderUser\Http\Requests\StoreNewOrderUserRequest;

class OrderUserController extends SharedController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orderUser = OrderUser::query()
        ->when(isset($request->id),fn($query)=> $query->where("id",$request->id))
        ->where("user_id", auth()->user()->id)
        ->with(['product'])
        ->get();

        return $this->api(OrderUserResource::collection($orderUser),__METHOD__);
    }


    public function getOrderUserByUserId(int $userId)
    {
        $orders =  OrderUser::query()
        ->where("user_id",$userId)
        ->with(['product'])
        ->get();

        

        return view("ProductUserView",compact("orders"));


    }



    /**
     * Store a newly created resource in storage.
     */
    public function store( StoreNewOrderUserRequest $request , OrderUser $orderUser) {

        if(! Auth::user()->phone_number || ! Auth::user()->postal_code)
            return $this->api(null,
        __METHOD__,
        "لطفا قبل از ثبت سفارش اطلاعات خود را تکمیل کنید",
        false,
        400);


        $validated = $request->validated();

        $validated['user_id'] = auth()->user()->id;


        $orderUser = $orderUser->AddNewOrderUser($validated);

        $orderUser->makeHidden("user_id");

        return $this->api(new OrderUserResource($orderUser->toArray()),__METHOD__);

    }

    public function update(UpdateOrderUserRequest $request , OrderUser $orderUser)
     {
        // dd($orderUser->toArray() , $request->toArray());

        $orderUser->updateOrderUser($request->all());

        dd($orderUser->all());
        // return $this->api()

     }

  
}
