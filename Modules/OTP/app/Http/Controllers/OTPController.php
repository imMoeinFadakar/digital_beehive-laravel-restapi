<?php

namespace Modules\Otp\Http\Controllers;

use Exception;
use Modules\Otp\Models\Otp;
use Modules\Otp\Services\VerifiOtpServices;
use Modules\Otp\Transformers\OtpResource;
use Modules\User\Models\User;
use Kavenegar\KavenegarApi;
use Modules\Otp\Http\Requests\SendOtpRequest;
use Modules\Otp\Http\Requests\VerifiOtpRequest;
use Modules\Otp\Services\SendOtpServices;
use Modules\Shared\Http\Controllers\SharedController;

class OtpController extends SharedController
{

   protected $sendOtpService;
   protected $verifiOtpService;

   public function __construct(SendOtpServices $sendOtpServices,VerifiOtpServices $verifiOtpServices)
   {
      $this->sendOtpService = $sendOtpServices;
      $this->verifiOtpService = $verifiOtpServices;
   }

   public function sendOtp(SendOtpRequest $requset, Otp $otp)
   {
      return  $this->sendOtpService->sendOtp($requset,$otp);
   }

   public function verifiOtp(VerifiOtpRequest $request)
   {
      return $this->verifiOtpService->verifiOtp($request);
   }


}
