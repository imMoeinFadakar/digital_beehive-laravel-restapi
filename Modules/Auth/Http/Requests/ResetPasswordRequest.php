<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "email" => "required|email|exists:users,email",
            "token" => "required",
            "password" => "required|min:8|confirmed"
        ];
    }

    public function messages()
    {
        return [
             'email.required' => 'وارد کردن ایمیل الزامی است.',
            'email.email' => 'فرمت ایمیل وارد شده معتبر نیست.',
            'email.exists' => 'ایمیلی با این مشخصات در سامانه یافت نشد.',

            'token.required' => 'توکن بازیابی رمز عبور الزامی است.',

            'password.required' => 'رمز عبور جدید الزامی است.',
            'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
            'password.confirmation' => 'رمز عبور و تکرار آن مطابقت ندارند.',
        ];
    }



    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
