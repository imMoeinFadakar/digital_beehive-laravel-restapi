<?php

namespace Modules\Otp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendOtpRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
           'phone_number' => 'required|regex:/^09\d{9}$/|exists:users,phone_number',
        ];
    }


    public function messages(): array
    {
        return [
             'phone_number.required' => 'وارد کردن شماره موبایل الزامی است.',
            'phone_number.regex' => 'شماره موبایل باید با 09 شروع شده و ۱۱ رقم باشد.',
            'phone_number.exists' => 'شماره موبایل وارد شده در سامانه ثبت نشده است.',
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
