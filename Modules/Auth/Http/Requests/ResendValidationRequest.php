<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResendValidationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "email" => "required|email|exists:users,email|regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/i"
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
             'email.required' => 'وارد کردن ایمیل الزامی است.',
            'email.email' => 'فرمت ایمیل معتبر نیست.',
            'email.exists' => 'این ایمیل قبلاً ثبت شده است.',
            'email.regex' => 'فرمت ایمیل معتبر نیست.',
        ];
    }



}
