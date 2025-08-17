<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\User\Models\User;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\HasApiTokens;
use Modules\Auth\Models\SellerUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Models\VerifiEmail;
use Modules\Shared\Traits\ApiResponseTrait;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Http\Requests\RegisterRequest;
use Modules\Auth\Http\Requests\VerifiEmailRequest;
use Modules\TelephoneSeller\Models\TelephoneSeller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Cache;
use Modules\Auth\Http\Requests\ResendValidationRequest;
use Modules\Auth\Notifications\ValidationEmailNotification;
use Modules\OrderUserStatus\Models\OrderUserstatus;

class AuthController extends Controller
{   
   use HasApiTokens,ApiResponseTrait; 

    /**
     * @param \Modules\Auth\Http\Requests\LoginRequest $Request
     * @return JsonResponse
     */
    public function login(LoginRequest $Request) {

            $validated = $Request->validated();
        
        $user  = $this->getUserByEmail($validated['email'],"active");

        if(! $user || ! $this->checkPassword($user->password,$validated['password']))
            return $this->api(null,__METHOD__,
            "کاربری یا این مشخصات در سیستم وجود ندارد",
            false,401);

        $this->loginUser($user);

        $token = $this->craeteAccessToken($user);

        $user = $this->removeNullIndexes($user->toArray());
        
        return $this->api(['user'=> $user , 'token'=> $token],
        __METHOD__,
        "با موفقیت وارد شدید");

    }

    /**
     * @param \Modules\User\Models\User $user
     */
    protected function loginUser(User $user)
    {
        return Auth::login($user);
    }

    /**
     * @param string $phoneNumber
     * @return User|null
     */
    protected function getUserByEmail(string $email,string $userStatus): User|null
    {
        return User::query()
        ->where("email",$email)
        ->where("status",$userStatus)
        ->first();
    }

    /**
     * @param string $userPassword
     * @param string $requestPassword
     * @return bool
     */
    protected function checkPassword(string $userPassword,string $requestPassword): ?bool
    {
        if(! Hash::check($requestPassword,$userPassword))
            return false;

        return true;
    }



    /**
     * @param array $array
     * @return array
     */
    public function removeNullIndexes(array $array): ?array
    {
        return array_filter($array, function($value) {
            return ! is_null($value);
        });
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

 





    public function register(RegisterRequest $request,VerifiEmail $verifiEmail,User $user)
    {
       $validated = $request->validated();

       //  create user
            $refferalCode = $this->generateRefferalCode();
            $validated["refferal_code"] = $refferalCode;
             $user = User::create($validated);
        
            $verifiEmail =  $verifiEmail->addNewVerifiEmail([
                "email" => $validated["email"],
                "code" => $this->generateRandomCode(),
                "expire_at" => now()->addMinutes(2)
            ]);
            
            if($request->has("seller_code")){
                
                $seller = $this->findTelephoneSeller($request->seller_code);
                if($seller && ! $this->isSellInvateExists($user->id,$seller->id))
                SellerUser::query()
                ->create([
                    "user_id" => $user->id,
                    "telephone_seller_id" => $seller->id
                ]);
            }

            $user->notify(new ValidationEmailNotification($verifiEmail->code));
       
            return $this->api(null,__METHOD__,
        "we send a email to {$user->email}");
    }

    public function resendValidationCode(ResendValidationRequest $request , VerifiEmail $verifiEmail)
    {
        // validate info
        $validated = $request->validated();

        $user = $this->getUserByEmail($validated['email'],"inactive");
        
        // is code exists
          if($this->isCodeExists($validated['email']))
                return $this->api(null,
            __METHOD__,"ما اخیرا برای شما کدی ارسال کردیم پس از 2 دقیقه دوباره تلاش کنید",
            false,400);


        $verifiEmail =  $verifiEmail->addNewVerifiEmail([
            "email" => $validated["email"],
            "code" => $this->generateRandomCode(),
            "expire_at" => now()->addMinutes(2)
        ]);


        $user->notify(new ValidationEmailNotification($verifiEmail->code));


             return $this->api(null,__METHOD__,
        "we send a email again to {$user->email}");

    }




    public function isSellInvateExists(int $userId,int $sellerId): ?bool
    {
        return SellerUser::query()
        ->where("user_id",$userId)
        ->where("telephone_seller_id",$sellerId)
        ->exists();

    }


    public function findTelephoneSeller(string $sellerCode): TelephoneSeller|null
    {
        return TelephoneSeller::query()
        ->where("personel_code",$sellerCode)
        ->first();
    }



    protected function generateRandomCode()
    {
        return rand(111111,999999);
    }


    protected function isCodeExists(string $email)
    {
        return VerifiEmail::query()
        ->where("email",$email)
        ->where("expire_at", ">", now())
        ->first();
    }



    public function verifiEmail(VerifiEmailRequest $request , VerifiEmail $verifiEmail )
    {
        $validated = $request->validated();
        $verifiCode = $verifiEmail->getVerifiCode($request->validated());
        if(! $verifiCode)
            return $this->api(null,__METHOD__,
        "کد معتبری یافت نشد",false,422);

        $user = $this->getUserByEmail($validated['email'],'inactive');

        $this->updateUserStatus($user);

        $this->deleteCode($verifiCode);

        $token = $this->craeteAccessToken($user);

        $userWithoutNullIndex = $this->removeNullIndexes($user->toArray());

        return $this->api(["user" => $userWithoutNullIndex , "token" => $token ],
        __METHOD__,"welcome!");
    }


    public function updateUserStatus(User $user)
    {
        $user->status = "active";
        $user->email_verified_at = now();
        $user->save();
    }

    public function deleteCode(object $code)
    {
        return $code->delete();
    }




    public function getValidationEmail($request)
    {
        return VerifiEmail::query()
        ->where("email",$request->email)
        ->where("token",$request->token)
        ->first();
    }


    /**
     * @param string $personelCode
     * @return TelephoneSeller|null
     */
    public function getSellerByPersonelCode(string $personelCode): TelephoneSeller|null
    {
        return TelephoneSeller::query()
        ->where("personel_code",$personelCode)
        ->where("status","active")
        ->first();
    }


    /**
     * @return string
     */
    public function generateRefferalCode(): ?string
    {
        $refferalCode =  Str::random(10);

        while($this->isRefferalCodeExists($refferalCode)){

            $refferalCode =  Str::random(10);

        }

        return $refferalCode;

    }

    /**
     * @param string $refferalCode
     * @return bool
     */
    protected function isRefferalCodeExists(string $refferalCode): ?bool
    {
        return User::query()
        ->where("refferal_code",$refferalCode)
        ->exists();
    }



}
