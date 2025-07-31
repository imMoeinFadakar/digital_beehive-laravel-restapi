<?php

namespace Modules\User\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "first_name" => "nullable|string|max:80",
            "last_name" => "nullable|string|max:80",
            "email" => ["nullable","email","unique:users,email"],
            "phone_number" => ['nullable', 'regex:/^09[0-9]{9}$/',"max:11"],
            "address" => ["nullable","max:250"],
            // "image" => ["nullable","image",],
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
