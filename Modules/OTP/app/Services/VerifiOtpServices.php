<?php

namespace Modules\Otp\Services;

use Modules\Otp\Http\Requests\VerifiOtpRequest;
use Modules\Otp\Models\Otp;
use Modules\User\Models\User;
use Modules\Otp\Transformers\OtpResource;
use Modules\Shared\Http\Controllers\SharedController;

class VerifiOtpServices extends SharedController
{
    public function verifiOtp(VerifiOtpRequest $request) {

     $validated = $request->validated();

      $code = $this->findCode($validated['code'],$validated['phone_number']);
      if(! $code)
         return $this->api(null,__METHOD__,"کد اشتباه است");

      $user = $this->findUser($validated['phone_number']);

      $token  =$user->createToken("USER AUTH OTP");

      return $this->api(new OtpResource(['user' => $user , "token" => $token]),
      __METHOD__);

    }

    protected function updateOtpCode($code)
   {
      $code->is_used = true;
      $code->save();
   }

   protected function findCode(int $code,int $phoneNumber): Otp|null
   {
      return Otp::query()
      ->where("otp_code",$code)
      ->where("is_used",false)
      ->where("phone_number",$phoneNumber)
      ->where('expires_at', '>', now())
      ->latest()
      ->first();
   }


   protected function findUser(int $phoneNumber): User|null
   {
      return User::query()
      ->where("phone_number",$phoneNumber)
      ->first();
   }

}
