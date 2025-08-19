<?php

namespace Modules\Activities\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [ 
            "activity_id" => "required|integer|exists:activities,id"
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
