<?php

namespace Modules\SellerProduct\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "seller_code" => "required|exists:sellers,seller_code",
            "product_code" => "required|integer|exists:product_codes,code",
        ];
    }


    public function messages()
    {
        return [
            'seller_code.required' => 'وارد کردن کد فروشنده الزامی است.',
            'seller_code.exists' => 'کد فروشنده وارد شده معتبر نیست یا در سیستم ثبت نشده است.',

            'product_code.required' => 'وارد کردن کد محصول الزامی است.',
            'product_code.integer' => 'کد محصول باید به‌صورت عددی وارد شود.',
            'product_code.exists' => 'کد محصول وارد شده در سیستم یافت نشد.',
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
