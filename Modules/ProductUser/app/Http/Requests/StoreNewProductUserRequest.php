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

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
