<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\User\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Shared\Http\Controllers\SharedController;

class AuthController extends SharedController
{

      /**
     * @param \Modules\Auth\Http\Requests\LoginRequest $Request
     */
    public function login(LoginRequest $Request) {

        
        
        if(! $this->attemptLogin($Request)) 
            return $this->api(null,
        __METHOD__,"username or password is wrong",false);
        
        $user = $this->getUser($Request); 
        
        
        if(! $user){
            return $this->api(null,
            __METHOD__,"user is not found",false); 
        }
        
        $token = $this->craeteAccessToken($user);
        
        $user = $this->removeNullIndexes($user->toArray());
        
        return $this->api(['user'=> $user , 'token'=> $token],__METHOD__,"login succesful welcome!");

    }

    public function removeNullIndexes(array $array): array
    {
        return array_filter($array, function($value) {
            return ! is_null($value);
        });
    }




    public function getUser($request): ?User
    {
        return User::query()
        ->where("username", $request->username)
        ->where('status','active')
        ->first() ?? null;
    }


    /**
     * @param mixed $request
     * @return bool
     */
    public function attemptLogin($request): ?bool
    {
       return  Auth::attempt($request->only(["email","password"]));
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
    public function craeteAccessToken(User $user): ?string
    {
        return $user->createToken("USER TOKEN")->plainTextToken;
    }

    /**
     * auth/logout
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
       $logout =  auth()->user()->currentAccessToken()->delete();
       if($logout) {

        return $this->api(null,__METHOD__,"you logged out");

       }
       
        return $this->api(null,message: "Unknown error occurred!", status: false, code: 500);
    }

    /**
     * @param \Modules\Auth\Http\Requests\RegisterRequest $request
     * @param \Modules\User\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request,User $user)
    {
        $user =  $user->addNewUser($request->validated());

        $token = $this->craeteAccessToken($user);

        return $this->api(["user"=>$user,"token"=>$token],__METHOD__);
    }



}
