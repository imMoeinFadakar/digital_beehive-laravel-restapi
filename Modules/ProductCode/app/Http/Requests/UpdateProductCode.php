<?php

namespace Modules\ProductCode\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductCode extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "status" => "required|string|in:used,not_used",
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
