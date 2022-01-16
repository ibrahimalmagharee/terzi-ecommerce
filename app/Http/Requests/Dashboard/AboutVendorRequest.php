<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AboutVendorRequest extends FormRequest
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
            'about' => 'required|max:500',
            'vendor_id' => 'required|numeric|exists:vendors,id',
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'about.required' => 'يرجى ادخال نبذة عن الشركة',
            'about.max' => 'يجب ان لا تتجاوز النبذة عن 500 حرف',
            'vendor_id.required' => 'يجب اختيار التاجر',
            'vendor_id.exist' => 'هذا التاجر غير موجود',
            'vendor_id.numeric' => 'يجب ان تكون القيمة رقم',
            'photo.required_without' => 'يجب ادخال صورة',
            'photo.mimes' => 'يجب ان تكون الصورة تحت صيغة jpg,jpeg,png',
        ];
    }
}
