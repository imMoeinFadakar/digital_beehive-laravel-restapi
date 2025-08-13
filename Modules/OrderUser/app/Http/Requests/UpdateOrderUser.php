<?php

namespace Modules\OrderUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderUser extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "quentity" => "nullable|integer",
            "status" => "required|string|in:canceled,in_proccess"
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
