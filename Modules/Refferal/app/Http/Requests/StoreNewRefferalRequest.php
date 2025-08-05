<?php

namespace Modules\Refferal\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewRefferalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "refferal_code" => "required|exists:users,refferal_code",
        ];
    }


    public function messages()
    {
        return [
            'refferal_code.required' => 'وارد کردن کد معرف الزامی است.',
            'refferal_code.exists' => 'کد معرف وارد شده نامعتبر است یا وجود ندارد.',
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
