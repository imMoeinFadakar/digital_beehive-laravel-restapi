<?php

namespace Modules\OrderUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeNewOrderUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "product_id" => "required|integer|exists:products,id" ,
            "quentity" => "required|min:1|max:10"
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
