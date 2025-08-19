<?php

namespace Modules\AuthOtpSms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class VerifiOtpRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "code" => "required|numeric|digits:6"
        ];
    }


    public function messages()
    {
        return [
            'code.required' => 'کد تایید الزامی است.',
            'code.numeric'  => 'کد تایید فقط می‌تواند عدد باشد.',
            'code.digits'   => 'کد تایید باید دقیقاً ۶ رقم باشد.',
            'code.exists'   => 'کد تایید وارد شده معتبر نیست یا منقضی شده است.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "status" => false,
            "message" => "validation failed",
            "data" => $validator->errors()
        ],429));
    }




    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
