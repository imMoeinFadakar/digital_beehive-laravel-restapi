<?php

namespace Modules\Otp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifiOtpRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "code" => "required|integer",
            'phone_number' => 'required|regex:/^09\d{9}$/', 
        ];
    }


    public function messages()
    {
        return [
            'code.required' => 'وارد کردن کد الزامی است.',
    'code.integer' => 'کد باید یک عدد معتبر باشد.',

    'phone_number.required' => 'وارد کردن شماره موبایل الزامی است.',
    'phone_number.regex' => 'شماره موبایل باید با 09 شروع شده و شامل ۱۱ رقم باشد.',
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
