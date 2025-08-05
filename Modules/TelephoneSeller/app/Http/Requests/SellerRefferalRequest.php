<?php

namespace Modules\TelephoneSeller\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerRefferalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "seller_code"  => "required|max:10|exists:telephone_sellers,personel_code"
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
