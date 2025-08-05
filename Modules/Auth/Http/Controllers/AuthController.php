<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\User\Models\User;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\App\Models\SellerUser;
use Modules\Shared\Traits\ApiResponseTrait;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Http\Requests\RegisterRequest;
use Modules\TelephoneSeller\Models\TelephoneSeller;

class AuthController extends Controller
{   
   use HasApiTokens,ApiResponseTrait; 
    // use ApiResponseTrait;

       /**
     * @param \Modules\Auth\Http\Requests\LoginRequest $Request
     */
    public function login(LoginRequest $Request) {

            $validated = $Request->validated();
        
        if(! $this->attemptLogin($validated)) 
            return $this->api(null,
        __METHOD__,"اطلاعات نادرست است",false,code: 422);
        
        $user = auth()->user();
        if(! $user){
            return $this->api(null,
            __METHOD__,"کاربر پیدا نشد",false,422); 
        }
        
        $token = $this->craeteAccessToken($user);
        
        $user = $this->removeNullIndexes($user->toArray());
        
        return $this->api(['user'=> $user , 'token'=> $token],
        __METHOD__,
        "با موفقیت وارد شدید");

    }

    /**
     * Summary of removeNullIndexes
     * @param array $array
     * @return array
     */
    public function removeNullIndexes(array $array): array
    {
        return array_filter($array, function($value) {
            return ! is_null($value);
        });
    }

    /**
     * @param mixed $request
     * @return bool
     */
    public function attemptLogin($validated): ?bool
    {
       return  Auth::attempt($validated);
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

        return $this->api(null,__METHOD__,"با موفقیت خارج شدید");

       }
       
        return $this->api(null,
        message: " ارور ناشناخته ایی اتفاق افتاد",
         status: false, code: 500);
    }

    /**
     * @param \Modules\Auth\Http\Requests\RegisterRequest $request
     * @param \Modules\User\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request,User $user): ?JsonResponse
    {
        $validated = $request->validated();

        $validated['refferal_code'] = $this->generateRefferalCode();
        
        $user =  $user->addNewUser($validated);

        if(isset($request->seller_code)){

            $seller = $this->getSellerByPersonelCode($request->seller_code);
        }
        
        if($seller && $seller != null){
            (new SellerUser())->AddNewSellerUser([
                "telephone_seller_id" => $seller->id,
                "user_id" => $user->id
            ]);
        }
            
        $token = $this->craeteAccessToken($user);

        return $this->api(["user"=>$user,"token"=>$token],__METHOD__);
    }


    public function getSellerByPersonelCode(int $personelCode): TelephoneSeller|null
    {
        return TelephoneSeller::query()
        ->where("personel_code",$personelCode)
        ->where("status","active")
        ->first() ?? null;
    }



    public function generateRefferalCode(): ?string
    {
        $refferalCode =  Str::random(10);

        while($this->isRefferalCodeExists($refferalCode)){

            $refferalCode =  Str::random(10);

        }

        return $refferalCode;

    }


    protected function isRefferalCodeExists(string $refferalCode): ?bool
    {
        return User::query()
        ->where("refferal_code",$refferalCode)
        ->exists();
    }



}
