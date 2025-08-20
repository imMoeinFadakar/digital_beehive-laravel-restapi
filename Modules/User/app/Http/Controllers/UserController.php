<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Shared\Traits\ApiResponseTrait;
use Modules\User\Models\User;
use Modules\User\Http\Requests\UserRequest;
use Modules\User\Transformers\UserResource;
use Modules\Shared\Http\Controllers\SharedController;

class UserController extends Controller
{
   use ApiResponseTrait;
    /**
     * user/index
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        return $this->api(new UserResource($user->toArray()),
        __METHOD__,"user index successfull");
    }

    /**
     * user/update
     * @param \Modules\User\Http\Requests\UserRequest $request
     * @param \Modules\User\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request,User $user)
    {
       $user = auth()->user();
       $user->update($request->validated());
        return $this->api(new UserResource($user->toArray()),__METHOD__);
    }

  
}
