<?php

namespace Modules\OTP\Services;

use Kavenegar\KavenegarApi;

use Modules\OTP\Models\Otp;
use Illuminate\Support\Facades\Http;
use Kavenegar\Exceptions\ApiException;
use Modules\Shared\Traits\DataTrait;

class KavenegarSmsServices
{

        protected $kavenegarApi;

    public function __construct(KavenegarApi $kavenegarApi)
    {
        $this->kavenegarApi = new KavenegarApi(env("KAVENEGAR_API_KEY"));
    }


    public function sendOtpCode($mobile, $code) 
    {

        $this->deletePerviousCode($mobile);

        $code = $this->generateCode($mobile);

        $this->addNewOtp($mobile,$code);
        
        try{

          return  $this->kavenegarApi->VerifyLookup($mobile, $code, null,null,"otp-login");

        }catch(ApiException $e){

            return [
                "status" => false,
                "message" => $e->getMessage() 
            ];
        }

    }

    public function addNewOtp($mobile, $code): ?Otp
    {
        return Otp::query()
        ->create($this->databaseArray(['code','phone','expires_at'],
        [$code,$mobile, now()->addMinutes(2) ]));

    }


    protected function generateCode($mobile): ?int
    {

        $code = rand(100000,900000);

        return $code;

    }

    protected function deletePerviousCode($mobile)
    {
       return  Otp::where("phone", $mobile)->delete();
    }

     protected function databaseArray(array $keys ,array $values ): ?array
    {
        return array_combine($keys , $values);
    }


}
