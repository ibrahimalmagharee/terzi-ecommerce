<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ContactVendorRequest extends FormRequest
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
            'vendor_id' => 'required|numeric|exists:vendors,id',
            'email' => 'required|email|max:100',
            'phone_number' => 'required|digits:10',
            'address_request' => 'required|max:150',
            'message' => 'required|max:1000',
        ];
    }

    public function messages()
    {
        return[
            'vendor_id.required' => 'يجب اختيار التاجر',
            'vendor_id.exist' => 'هذا التاجر غير موجود',
            'vendor_id.numeric' => 'يجب ان تكون القيمة رقم',
            'email.required' => 'يرجى ادخال البريد الالكتروني',
            'email.email' => 'يرجى التحقق من صيعة البريد الالكتروني المدخل',
            'email.max' => 'هذا الايميل يجب ان لا يتجاوز 100 حانة',
            'phone_number.required' => 'يرجى ادخال رقم الجوال',
            'phone_number.digits' => 'يجب ان يكون رقم الجوال 10 أرقام ',
            'address_request.required' => 'يرجى ادخال عنوان الطلب',
            'address_request.max' => 'يجب ان لا يزيد عنوان الطلب عن 150 حرف',
            'message.required' => 'يجب ادخال الرسالة',
            'message.max' => 'الرسالة يجب ان لا تزيد عن 1000 حرف',
        ];

    }
}
