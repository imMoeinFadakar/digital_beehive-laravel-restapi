<?php

namespace Modules\OrderUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewOrderUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "product_id" => "required|integer|exists:products,id" ,
            "quentity" => "required|min:1|max:10",
            "transaction_number" => "nullable|integer"
        ];
    }


    public function messages()
    {
        return [
            'product_id.required' => 'انتخاب محصول الزامی است.',
            'product_id.integer' => 'شناسه محصول باید عددی باشد.',
            'product_id.exists' => 'محصول انتخاب‌شده در سیستم یافت نشد.',

            'quentity.required' => 'تعیین تعداد محصول الزامی است.',
            'quentity.min' => 'تعداد محصول نمی‌تواند کمتر از ۱ باشد.',
            'quentity.max' => 'تعداد محصول نمی‌تواند بیشتر از ۱۰ باشد.',
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
