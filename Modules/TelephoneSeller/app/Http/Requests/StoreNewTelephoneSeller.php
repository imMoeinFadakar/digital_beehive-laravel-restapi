<?php

namespace Modules\TelephoneSeller\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewTelephoneSeller extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "first_name" => "required|string|min:3|max:80",
            "last_name" => "required|string|min:3|max:80",
            "father_name" => "required|string|min:3|max:80",
            "national_code" => "required|unique:telephone_sellers,national_code",
            "issue_place" => "required|string|min:3|max:80",
            "birth_date" => "required|date|date_format:Y-m-d|before:today",
            "married_status" => "required|string|in:single,married",
            "address" => "required|min:10|max:200",
            "emergency_phone" => "required|regex:/^09[0-9]{9}$/",
            "any_teammate_family" => "nullable|max:250",
            "extera_activity" => "nullable|max:250",
            "health_status" => "nullable|max:250",
            "punishment_history" => "nullable|max:250",
            "educational_background" => "required|max:250",
            'field_of_study'=>"required|max:250",
            'institution_name' => "required|max:250",
            'Position' => "required|max:250",
            "field_of_activity" => "required|max:250",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,png|max:2048',
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
