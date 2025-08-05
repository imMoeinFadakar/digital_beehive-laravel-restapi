<?php

namespace Modules\ProductUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeNewProductUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "code" => "required|integer",
            "product_id" => "required|integer|exists:products,id",
        ];
    }

    public function messages()
    {
        return [
        'code.required' => 'وارد کردن کد الزامی است.',
        'code.integer' => 'کد باید یک عدد معتبر باشد.',

        'product_id.required' => 'انتخاب محصول الزامی است.',
        'product_id.integer' => 'شناسه محصول باید به صورت عددی وارد شود.',
        'product_id.exists' => 'محصول انتخاب‌شده در سیستم وجود ندارد یا حذف شده است.',
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
