<?php

namespace Modules\OrderUserStatus\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewOrderUserStatus extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "seller_code" => "required|exists:telephone_sellers,personel_code"
        ];
    }


    public function messages()
    {
        return [
             'seller_code.required' => 'کد فروشنده الزامی است.',
            'seller_code.exists'   => 'کد فروشنده وارد شده معتبر نیست.',
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
