<?php

namespace Modules\Auth\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\User\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Modules\Auth\Http\Requests\ResetPasswordRequest;
use Modules\Auth\Http\Requests\ForgetPasswordRequest;
use Modules\Shared\Http\Controllers\SharedController;
use Modules\Auth\Notifications\ResetPasswordNotification;

class ForgetPasswordController extends SharedController
{
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        try{
               $validated = $request->validated();

        $user = $this->getUserByEmail($validated['email'],"active");
        if(! $user)
            return $this->api(null,__METHOD__,
        "کاربر یافت نشد",false,422);
        
        $token = Password::createToken($user);
        
        $user->notify(new ResetPasswordNotification($token));


            return $this->api(null,__METHOD__,"we send a reset link to {$user->email}");

        }catch(Exception $e){

            return $this->api(null,__METHOD__,$e->getMessage(),false,400);

        }
     
        

    }


    protected function getUserByEmail(string $email,string $userStatus): User|null
    {
        return User::query()
        ->where("email",$email)
        ->where("status",$userStatus)
        ->first();
    }



    public function resetPassword(ResetPasswordRequest $request)
    {


        try{

         $status = Password::reset(
            $request->validated(),

            function ($user, $password) {

                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'رمز عبور با موفقیت تغییر یافت'])
            : response()->json(['message' => 'توکن یا ایمیل معتبر نیست'], 400);


        }catch(Exception $e){

            return $this->api(null,
            __METHOD__,
            "error" . $e->getMessage(). ' ' . $e->getLine());

        }

     
    }




}
