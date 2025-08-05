<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "email" => "required|email|unique:users,email",
            'password' => 'required|min:8|confirmed',
            "first_name" => 'required|string|min:3|max:80|regex:/^[\p{Arabic} ]+$/u',
            "last_name" => 'required|string|min:3|max:80|regex:/^[\p{Arabic} ]+$/u',
            "phone_number" => 'required|regex:/^09\d{9}$/|unique:users,phone_number' ,
            "seller_code" => "nullable|max:10|exists:telephone_sellers,personel_code"
        ];
        
    }


    public function messages()
    {
        return [
            'email.required' => 'وارد کردن ایمیل الزامی است.',
            'email.email' => 'فرمت ایمیل معتبر نیست.',
            'email.unique' => 'این ایمیل قبلاً ثبت شده است.',

            'password.required' => 'وارد کردن رمز عبور الزامی است.',
            'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
            'password.confirmed' => 'رمز عبور و تکرار آن با هم مطابقت ندارند.',

            'first_name.required' => 'وارد کردن نام الزامی است.',
            'first_name.string' => 'نام باید به صورت رشته‌ای باشد.',
            'first_name.min' => 'نام باید حداقل ۳ کاراکتر باشد.',
            'first_name.max' => 'نام نمی‌تواند بیشتر از ۸۰ کاراکتر باشد.',
            'first_name.regex' => 'نام باید فقط شامل حروف فارسی باشد.',
    
            'last_name.required' => 'وارد کردن نام خانوادگی الزامی است.',
            'last_name.string' => 'نام خانوادگی باید به صورت رشته‌ای باشد.',
            'last_name.min' => 'نام خانوادگی باید حداقل ۳ کاراکتر باشد.',
            'last_name.max' => 'نام خانوادگی نمی‌تواند بیشتر از ۸۰ کاراکتر باشد.',
            'last_name.regex' => 'نام خانوادگی باید فقط شامل حروف فارسی باشد.',


            'phone_number.required' => 'وارد کردن شماره موبایل الزامی است.',
            'phone_number.regex' => 'شماره موبایل باید با 09 شروع شده و ۱۱ رقم باشد.',
            'phone_number.unique' => 'این شماره موبایل قبلاً ثبت شده است.',

            'seller_code.min'    => 'کد فروشنده باید حداقل 10 رقم باشد.',
            'seller_code.exists' => 'کد فروشنده وارد شده معتبر نیست یا وجود ندارد.',
        ];
    }

   public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
   {
        return response()->json([
            "status" => false,
            "message" => "خطا در اعتبارسنجی داده",
            "error" => $validator->errors()
        ],422);
   }


    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
