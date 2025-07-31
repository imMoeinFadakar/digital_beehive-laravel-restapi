<?php

namespace Modules\OrderUser\Http\Controllers;

use Modules\OrderUser\Http\Requests\storeNewOrderUserRequest;
use Modules\OrderUser\Http\Requests\UpdateOrderUserRequest;
use Modules\OrderUser\Models\OrderUser;
use Modules\OrderUser\Transformers\OrderUserResource;
use Modules\Shared\Http\Controllers\SharedController;

class OrderUserController extends SharedController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderUser = OrderUser::query()
        ->where("user_id", auth()->user()->id)
        ->with(['product'])
        ->get();

        return $this->api(OrderUserResource::collection($orderUser),__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeNewOrderUserRequest $request , OrderUser $orderUser) {

        $validated = $request->validated();

        $validated['user_id'] = auth()->user()->id;


        $orderUser = $orderUser->AddNewOrderUser($validated);

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
