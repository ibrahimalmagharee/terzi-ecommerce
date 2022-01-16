<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class HeaderPhotoRequest extends FormRequest
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
            'header_photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'vendor_id' => 'required|numeric|exists:vendors,id',
        ];
    }

    public function messages()
    {
        return [
            'header_photo.required_without' => 'يجب اختيار الصورة',
            'header_photo.mimes' => 'يجب ان تكون الصورة تحت صيغة jpg,jpeg,png',
            'vendor_id.required' => 'يجب اختيار التاجر',
            'vendor_id.exist' => 'هذا التاجر غير موجود',
            'vendor_id.numeric' => 'يجب ان تكون القيمة رقم',
        ];
    }
}
