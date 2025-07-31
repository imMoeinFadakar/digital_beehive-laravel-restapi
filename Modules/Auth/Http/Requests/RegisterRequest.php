<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "username" => "required|email|unique:users,username",
            'password' => 'required|min:8|confirmed',
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
