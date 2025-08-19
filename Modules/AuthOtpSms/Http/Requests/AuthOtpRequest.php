<?php

namespace Modules\AuthOtpSms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthOtpRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "phone" => ['required','regex:/^09\d{9}$/'],
        ];
    }

    public function messages()
    {
        return [
            'phone_number.required' => 'وارد کردن شماره موبایل الزامی است.',
            'phone_number.regex'    => 'شماره موبایل باید با 09 شروع شود و 11 رقم باشد.',
            'phone_number.unique'   => 'این شماره موبایل قبلاً ثبت شده است.',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new  HttpResponseException(
            response()->json([
                "status" => false,
                "message" => "validation failed",
                "data" => $validator->errors()
            ],429)
        );
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
