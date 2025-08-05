<?php

namespace Modules\Otp\Services;

use Exception;
use Kavenegar\KavenegarApi;
use Modules\Otp\Models\Otp;
use Modules\Otp\Http\Requests\SendOtpRequest;
use Modules\Shared\Http\Controllers\SharedController;

class SendOtpServices extends SharedController
{
    public function sendOtp(SendOtpRequest $requset, Otp $otp) 
       {
      
      $validated = $requset->validated();

      $code = $this->generateOtpCode();

      $validated['otp_code'] = $code;
      $validated['expires_at'] = now()->addMinutes(2);


      $otp->addNewOtpCode($validated);

      try{

         $kavenegar  = new KavenegarApi(env("KAVENEGAR_API_KEY"));

         $kavenegar->Send(
            "عسل کوهپایه",
            $otp->phone_number,
            "خوش امدید کد شما : $code ",
         );

      }catch(Exception $e){

         return $this->api(null,__METHOD__,"خطایی در ارسال پیام اتفاق افتاد" . $e->getMessage());

      }

         return $this->api(null,__METHOD__,"پیام با موفقیت ارسال شد");

   }

    protected function generateOtpCode(): int
   {
      return rand(111111,999999);
   }

}
