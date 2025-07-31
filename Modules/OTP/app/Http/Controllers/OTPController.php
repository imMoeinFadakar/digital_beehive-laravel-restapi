<?php

namespace Modules\OTP\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OTP\Http\Requests\OTPRequest;
use Modules\OTP\Models\OTP;
use Modules\OTP\Traits\KavehnegarSmsTrait;
use Modules\Shared\Http\Controllers\SharedController;
use Modules\User\Models\User;

class OTPController extends SharedController
{
    use KavehnegarSmsTrait;
    public function sendOtp(OTPRequest $request,OTP $otp)
    {
        $code = $this->generateOtpCode();

        $otp = $otp->addNewOtp($request->validated());
        
        $response =   $this->sendOtpCode($otp->phone, $code);

        return $this->api(null,__METHOD__,$response);


    }

    protected function generateOtpCode(): ?int
    {
        return rand(100000,900000);
    }


}
