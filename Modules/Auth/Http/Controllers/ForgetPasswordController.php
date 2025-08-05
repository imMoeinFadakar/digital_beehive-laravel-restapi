<?php

namespace Modules\Auth\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Modules\Auth\Http\Requests\ResetPasswordRequest;
use Modules\Auth\Http\Requests\ForgetPasswordRequest;
use Modules\Shared\Http\Controllers\SharedController;

class ForgetPasswordController extends SharedController
{
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $validated = $request->validated();

        $status = Password::sendResetLink($validated['email']);

        return $status === Password::RESET_LINK_SENT ?
        $this->api(null,__METHOD__,
        "لینک بازیابی رمز عبور به ایمیل شمار ارسال شد") :
        $this->api(null,__METHOD__,
        "خطای ناشناخته ایی پیش امد");

    }


    public function resetPassword(ResetPasswordRequest $request)
    {
        

        try{

               $status = Password::reset(
            $request->only("email","token","password"),
            function($user,$request){

                $user->forceFill([
                    "password" => $request->password,
                    "remember_token" => Str::random(60)
                ]);

                $user->save();


                event(new PasswordReset($user));
            }
        );

               return $status === Password::PASSWORD_RESET ?
         $this->api(null,__METHOD__,"پسورد با موفقیت تغییر کرد"):
         $this->api(null,__METHOD__,"خطای ناشناخته",
         false,422);



        }catch(Exception $e){

            return $this->api(null,
            __METHOD__,
            "خطا" . $e->getMessage(). ' ' . $e->getLine());

        }

     
    }




}
