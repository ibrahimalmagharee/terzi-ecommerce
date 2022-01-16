<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ContactUSRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required|numeric|exists:customers,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|max:1000',
        ];
    }

    public function messages()
    {
        return[
            'customer_id.required' => 'يجب اختيار الزبون',
            'customer_id.exist' => 'هذا الزبون غير موجود',
            'customer_id.numeric' => 'يجب ان تكون القيمة رقم',
            'first_name.required' => 'يجب ادخال الاسم الاول',
            'first_name.string' => 'يجب ان يكون الاسم الاول نص',
            'first_name.max' => 'يجب ان لا يتعدى الاسم الاول عن 100 حرق',
            'last_name.required' => 'يجب ادخال الاسم الاخير',
            'last_name.string' => 'يجب ان يكون الاسم الاخير نص',
            'last_name.max' => 'يجب ان لا يتعدى الاسم الاخير عن 100 حرق',
            'email.required' => 'يرجى ادخال البريد الالكتروني',
            'email.email' => 'يرجى التحقق من صيعة البريد الالكتروني المدخل',
            'email.max' => 'هذا الايميل يجب ان لا يتجاوز 100 حانة',
            'message.required' => 'يجب ادخال الرسالة',
            'message.max' => 'الرسالة يجب ان لا تزيد عن 1000 حرف',
        ];

    }
}
