<?php

namespace Modules\Guests\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addNewGuestRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "first_name" => "required|string|min:3|max:80",
            "last_name" => "required|string|min:3|max:80",
            "phone" => "required|regex:/^09\d{9}$/",
            "code" => "required|integer|exists:guest_cards,code",
        ];
    }


    public function messages()
    {
        return [
            'first_name.required' => 'وارد کردن نام الزامی است.',
            'first_name.string' => 'نام باید به صورت رشته‌ای وارد شود.',
            'first_name.min' => 'نام باید حداقل ۳ حرف داشته باشد.',
            'first_name.max' => 'نام نمی‌تواند بیش از ۸۰ کاراکتر باشد.',

            'last_name.required' => 'وارد کردن نام خانوادگی الزامی است.',
            'last_name.string' => 'نام خانوادگی باید به صورت رشته‌ای وارد شود.',
            'last_name.min' => 'نام خانوادگی باید حداقل ۳ حرف داشته باشد.',
            'last_name.max' => 'نام خانوادگی نمی‌تواند بیش از ۸۰ کاراکتر باشد.',

            'phone.required' => 'شماره تلفن همراه الزامی است.',
            'phone.regex' => 'شماره تلفن همراه باید با 09 شروع شده و ۱۱ رقم باشد.',

            'code.required' => 'وارد کردن کد دعوت الزامی است.',
            'code.integer' => 'کد دعوت باید عددی باشد.',
            'code.exists' => 'کد دعوت وارد شده معتبر نیست یا وجود ندارد.',
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
