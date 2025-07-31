<?php

namespace Modules\OTP\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OTPRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "phone_number" => "required|regex:/^09\d{9}$/",
        ];
    }


    public function messages()
    {
        return [
            "phone_number.unique" => "با این شماره قبلا ثبت نام شده است",
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
