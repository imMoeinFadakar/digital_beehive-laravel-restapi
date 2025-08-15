<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "user_id" => "required|integer|exists:users,id",
            "title" => "required|string|max:80|regex:/^[\x{0600}-\x{06FF}]+$/u",
            "status" => "required|string|in:called,rejected",
            "description" => "required|max:250|regex:/^[\x{0600}-\x{06FF}]+$/u"
        ];
    }
    public function messages()
{
    return [
        // user_id
        'user_id.required' => 'شناسه کاربر الزامی است.',
        'user_id.integer'  => 'شناسه کاربر باید عدد باشد.',
        'user_id.exists'   => 'کاربر انتخاب‌شده معتبر نیست.',

        // title
        'title.required' => 'عنوان الزامی است.',
        'title.string'   => 'عنوان باید متنی باشد.',
        'title.max'      => 'عنوان نباید بیش از ۸۰ کاراکتر باشد.',
        'title.regex'    => 'عنوان فقط باید شامل حروف فارسی باشد.',

        // status
        'status.required' => 'وضعیت الزامی است.',
        'status.string'   => 'وضعیت باید متنی باشد.',
        'status.in'       => 'وضعیت انتخاب‌شده معتبر نیست.',

        // description
        'description.required' => 'توضیحات الزامی است.',
        'description.max'      => 'توضیحات نباید بیش از ۲۵۰ کاراکتر باشد.',
        'description.regex'    => 'توضیحات فقط باید شامل حروف فارسی باشد.',
    ];
}



}
