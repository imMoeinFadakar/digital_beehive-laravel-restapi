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

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
