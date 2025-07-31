<?php

namespace Modules\Beehive\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBeehiveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "beehive_id" => "required|integer|exists:beehives,id",
            "power" => "required|integer|min:2",
            "bee_count"=> "nullable|integer|min:2",
            "frame_count" => "nullable|integer|min:2",
            "honey_amount" =>  "nullable|integer|min:2"
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
