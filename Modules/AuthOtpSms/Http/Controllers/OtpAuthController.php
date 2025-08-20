<?php

namespace Modules\AuthOtpSms\Http\Controllers;

use Exception;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\User\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\HasApiTokens;
use Modules\AuthOtpSms\Models\OtpAuth;
use Modules\AuthOtpSms\Traits\SendSmsTrait;
use Modules\Shared\Traits\ApiResponseTrait;
use Modules\AuthOtpSms\Http\Requests\AuthOtpRequest;
use Modules\AuthOtpSms\Http\Requests\VerifiOtpRequest;

class OtpAuthController extends Controller
{
    use SendSmsTrait,ApiResponseTrait,HasApiTokens;

      public function sendOtpCode(AuthOtpRequest $request)
    {
        $validated = $request->validated();
        
        $newOtpCode = $this->createNewOtpCode($this->generateRandomCode(),$validated['phone']);
        
        $this->sendSms($validated["phone"],$newOtpCode->code);

        return $this->api(null,__METHOD__,
        "ما یک کد تایید به {$validated["phone"]} ارسال کردیم");
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



    public function verifiOtpCode(VerifiOtpRequest $request)
    {
        $validated = $request->validated();

        $otpCode = $this->findOtpCode("code",$validated['code']);
        if(! $otpCode)
            return $this->api(null,__METHOD__,
        "کد معتبر یافت نشد",false,400);

        $user = $this->findOrCreateUser($otpCode->phone);

        $this->loginUser($user);

        $token = $this->craeteAccessToken($user);

        $otpCode->delete();

        return $this->api(["token" => $token,"user" => $user],__METHOD__);
    }


    public function resendOtpCode(AuthOtpRequest $request)
    {
        $validated = $request->validated();
        $otpCode = $this->findOtpCode("phone",$validated['phone']);
        if($otpCode)
            return $this->api(null,__METHOD__,
        "کد قبلی شما هنوز اعتبار دارد. اعتبار هر کد: 3 دقیقه",
        false,400);
         
        $newCode = $this->createNewOtpCode($this->generateRandomCode(),$validated['phone']);
        $this->sendSms($newCode->phone,$newCode->code);

               return $this->api(null,__METHOD__,
        "ما مجدد  یک کد تایید به {$validated["phone"]} ارسال کردیم");
    }

    public function createNewOtpCode(int $code,string $phone)
    {
      return OtpAuth::create([
            "code" => $code,
            "phone" => $phone,
            "expires_at" => Carbon::now()->addMinutes(3)
        ]);
    }

    /**
     * @param \Modules\User\Models\User $user
     */
    protected function loginUser(User $user)
    {
        return Auth::login($user);
    }

    /**
     * @param mixed $user
     */
    protected function craeteAccessToken(User $user): ?string
    {
        return $user->createToken("USER TOKEN")->plainTextToken;
    }

    /**
     * Summary of findOtpCode
     * @param int $code
     * @return OtpAuth|null
     */
    protected function findOtpCode(string $index,$value)
    {
        return OtpAuth::query()
        ->where($index,$value)
        ->where("used",false)
        ->where("expires_at",">",now())
        ->latest()
        ->first();
    }

    /**
     * Summary of generateRandomCode
     * @return int
     */
    public function generateRandomCode()
    {
        return rand(111111,999999);
    }


   
       /**
     * Summary of addNewOtpCode
     * @param string $code
     * @param string $phoneNumber
     * @return OtpAuth
     */
    protected function addNewOtpCode(string $code,string $phoneNumber): ?OtpAuth
    {
        return OtpAuth::query()
        ->create(attributes: [
            "code" => $code,
            "phone_number" => $phoneNumber,
            "expire_at" => now()->addMinutes(2)
        ]);
    }

    /**
     * Summary of findOrCreate
     * @param string $phoneNumber
     */
    protected function findOrCreateUser(string $phoneNumber)
    {
        return User::firstOrCreate(
            ["phone_number" => $phoneNumber,"status"=>"active"],
            ["status" => "active",
            "refferal_code" => $this->generateRefferalCode()]
        );
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
