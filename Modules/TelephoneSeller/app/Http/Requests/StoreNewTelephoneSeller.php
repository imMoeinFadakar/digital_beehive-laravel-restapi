<?php

namespace Modules\TelephoneSeller\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

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
            "father_name" => "nullable|string|min:3|max:80",
            "national_code" => "required|unique:telephone_sellers,national_code",
            "issue_place" => "nullable|string|min:3|max:80",
            "birth_date" => "nullable|date|date_format:Y-m-d|before:today",
            "married_status" => "nullable|string|in:single,married",
            "address" => "nullable|min:10|max:200",
            "emergency_phone" => "required|regex:/^09[0-9]{9}$/|unique:telephone_sellers,emergency_phone",
            "any_teammate_family" => "nullable|max:250",
            "extera_activity" => "nullable|max:250",
            "health_status" => "nullable|max:250",
            "punishment_history" => "nullable|max:250",
            "educational_background" => "nullable|max:250",
            'field_of_study'=>"nullable|max:250",
            'institution_name' => "nullable|max:250",
            'Position' => "nullable|max:250",
            "field_of_activity" => "nullable|max:250",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,png|max:2048',
        ];
    }


    public function messages()
    {
        return [
           'first_name.required' => 'نام را وارد کنید.',
    'first_name.string' => 'نام باید به صورت رشته‌ای باشد.',
    'first_name.min' => 'نام باید حداقل ۳ کاراکتر باشد.',
    'first_name.max' => 'نام نباید بیشتر از ۸۰ کاراکتر باشد.',

    'last_name.required' => 'نام خانوادگی را وارد کنید.',
    'last_name.string' => 'نام خانوادگی باید به صورت رشته‌ای باشد.',
    'last_name.min' => 'نام خانوادگی باید حداقل ۳ کاراکتر باشد.',
    'last_name.max' => 'نام خانوادگی نباید بیشتر از ۸۰ کاراکتر باشد.',

    'father_name.string' => 'نام پدر باید به صورت رشته‌ای باشد.',
    'father_name.min' => 'نام پدر باید حداقل ۳ کاراکتر باشد.',
    'father_name.max' => 'نام پدر نباید بیشتر از ۸۰ کاراکتر باشد.',

    'national_code.required' => 'کد ملی را وارد کنید.',
    'national_code.unique' => 'این کد ملی قبلاً ثبت شده است.',

    'issue_place.string' => 'محل صدور باید به صورت رشته‌ای باشد.',
    'issue_place.min' => 'محل صدور باید حداقل ۳ کاراکتر باشد.',
    'issue_place.max' => 'محل صدور نباید بیشتر از ۸۰ کاراکتر باشد.',

    'birth_date.date' => 'تاریخ تولد باید یک تاریخ معتبر باشد.',
    'birth_date.date_format' => 'فرمت تاریخ تولد باید به صورت YYYY-MM-DD باشد.',
    'birth_date.before' => 'تاریخ تولد باید قبل از امروز باشد.',

    'married_status.string' => 'وضعیت تأهل باید رشته‌ای باشد.',
    'married_status.in' => 'وضعیت تأهل باید یکی از گزینه‌های «مجرد» یا «متأهل» باشد.',

    'address.min' => 'آدرس باید حداقل ۱۰ کاراکتر باشد.',
    'address.max' => 'آدرس نباید بیشتر از ۲۰۰ کاراکتر باشد.',

    'emergency_phone.required' => 'شماره تماس اضطراری الزامی است.',
    'emergency_phone.regex' => 'شماره تماس اضطراری باید با 09 شروع شده و ۱۱ رقم باشد.',
    'emergency_phone.unique' => 'این شماره تماس اضطراری قبلاً ثبت شده است.',

    'any_teammate_family.max' => 'اطلاعات مربوط به اعضای خانواده نباید بیشتر از ۲۵۰ کاراکتر باشد.',
    'extera_activity.max' => 'اطلاعات فعالیت‌های جانبی نباید بیشتر از ۲۵۰ کاراکتر باشد.',
    'health_status.max' => 'وضعیت سلامت نباید بیشتر از ۲۵۰ کاراکتر باشد.',
    'punishment_history.max' => 'سابقه محکومیت نباید بیشتر از ۲۵۰ کاراکتر باشد.',
    'educational_background.max' => 'سوابق تحصیلی نباید بیشتر از ۲۵۰ کاراکتر باشد.',
    'field_of_study.max' => 'رشته تحصیلی نباید بیشتر از ۲۵۰ کاراکتر باشد.',
    'institution_name.max' => 'نام مؤسسه نباید بیشتر از ۲۵۰ کاراکتر باشد.',
    'Position.max' => 'موقعیت شغلی نباید بیشتر از ۲۵۰ کاراکتر باشد.',
    'field_of_activity.max' => 'زمینه فعالیت نباید بیشتر از ۲۵۰ کاراکتر باشد.',

    'image.required' => 'آپلود تصویر الزامی است.',
    'image.image' => 'فایل انتخاب‌شده باید تصویر باشد.',
    'image.mimes' => 'فرمت تصویر باید یکی از فرمت‌های jpeg، png، jpg، gif یا webp باشد.',
    'image.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
        ];
    }

        public function failedValidation(Validator $validator)
        {
            return response()->json([
            'status' => false,
            'message' => 'خطا در اعتبارسنجی داده‌ها',
            'errors' => $validator->errors()
        ], 422);
        }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }





    
}
