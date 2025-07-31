<?php

namespace Modules\Guests\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addNewGuestRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "first_name" => "required|string|min:3|max:80",
            "last_name" => "required|string|min:3|max:80",
            "phone" => "required|regex:/^09\d{9}$/",
            "code" => "required|integer|exists:guest_cards,code",
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
