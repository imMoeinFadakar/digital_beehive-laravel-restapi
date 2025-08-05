<?php

namespace Modules\User\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "address" => ["required","max:250"],
          "postal_code" => ["required", "regex:/^[0-9]{10}$/"]
        ];
    }

    public function messages()
    {
        return [
            'address.required' => 'وارد کردن آدرس الزامی است.',
            'address.max' => 'آدرس نباید بیشتر از ۲۵۰ کاراکتر باشد.',

            'postal_code.required' => 'وارد کردن کد پستی الزامی است.',
    'postal_code.regex' => 'کد پستی باید دقیقا ۱۰ رقم عددی و بدون فاصله یا حروف باشد.',
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
