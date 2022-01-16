<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class LogoVendorRequest extends FormRequest
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
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'vendor_id.required' => 'يجب اختيار التاجر',
            'vendor_id.exist' => 'هذا التاجر غير موجود',
            'vendor_id.numeric' => 'يجب ان تكون القيمة رقم',
            'photo.required_without' => 'يجب ادخال صورة',
            'photo.mimes' => 'يجب ان تكون الصورة تحت صيغة jpg,jpeg,png',
        ];
    }
}
