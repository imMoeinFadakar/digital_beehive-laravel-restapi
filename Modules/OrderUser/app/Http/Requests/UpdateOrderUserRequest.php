<?php

namespace Modules\OrderUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "status" => "required|string|in:in_proccess,canceled",
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
