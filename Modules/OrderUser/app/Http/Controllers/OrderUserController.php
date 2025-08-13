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
use Modules\OrderUser\Http\Requests\UpdateOrderUser;

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

        $orderUser->makeHidden("user_id");


        return $this->api(OrderUserResource::collection($orderUser),__METHOD__);
    }

    /**
     * @param int $userId
     * @return \Illuminate\Contracts\View\View
     */
    public function getOrderUserByUserId(int $userId)
    {
        $orders =  OrderUser::query()
        ->where("user_id",$userId)
        ->with(['product'])
        ->get();

        return view("ProductUserView",compact("orders"));

    }



    /**
     * order-user/store
     * @param \Modules\OrderUser\Http\Requests\StoreNewOrderUserRequest $request
     * @param \Modules\OrderUser\Models\OrderUser $orderUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function store( StoreNewOrderUserRequest $request , OrderUser $orderUser) {

    
        $validated = $request->validated();

        $validated['user_id'] = auth()->user()->id;

        $orderUser = $orderUser->AddNewOrderUser($validated);

        $orderUser->makeHidden("user_id");

        return $this->api(new OrderUserResource($orderUser->toArray()),__METHOD__);

    }

    public function update(UpdateOrderUser $request, OrderUser $orderUser,$id)
    {
       $order =  $orderUser->find($id);
        
        $order->update($request->validated());


        return $this->api(new OrderUserResource($order->toArray()),__METHOD__);
    }





  
}
