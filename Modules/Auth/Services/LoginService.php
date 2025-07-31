<?php

namespace Modules\Auth\Services;

use Modules\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Traits\ApiResponse;
use Modules\Auth\Http\Requests\LoginRequest;


class LoginService
{
    use ApiResponse;

    /**
     * @param \Modules\Auth\Http\Requests\LoginRequest $loginRequest
     */
    public function login(LoginRequest $loginRequest) {

      

        if(! $this->attemptLogin($loginRequest)) 
            return $this->apiResponse(null,
        __METHOD__,"username or password is wrong",false);

        $user = $this->getUser($loginRequest->product_code);

        if(! $user){
            return $this->apiResponse(null,
        __METHOD__,"user is not found",false); 
        }


        $token = $this->craeteSanctumToken($user);


        return ["user" => $user,"token" => $token];

    }

    /**
     * @param int $productCode
     * @return User|null
     */
    public function getUser(int $productCode): User|null
    {
        return User::query()
        ->where("product_code", $productCode)
        ->where('status','active')
        ->first() ?? null;
    }


    /**
     * @param mixed $request
     * @return bool
     */
    public function attemptLogin($request): ?bool
    {
       return  Auth::attempt($request->only(["product_code","password"]));
    }


    /**
     * @param int $productCode
     * @return User|null
     */
    public function findUserByProductCode(int $productCode): User|null
    {
        return User::query()
        ->where("product_code", $productCode)
        ->first() ?? null;
    }

 
    /**
     * @param mixed $user
     */
    public function craeteSanctumToken($user)
    {
        return $user->createToken("USER TOKEN")->plainTextToken;
    }

}
