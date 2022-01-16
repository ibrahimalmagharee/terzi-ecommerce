<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class HeaderBottomIndexRequest extends FormRequest
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
            'description' => 'required|max:500',
            'type' => 'required|numeric|in:1,2,3',
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'يرجى ادخال الوصف ',
            'description.max' => 'يجب ان لا يتجاوز الوصف عن 500 حرف',
            'type.required' => 'يرجى اختيار نوغ الرأسية',
            'type.numeric' => 'يجب ان يكون نوع الرأسية رقم  ',
            'type.in' => 'يجب ان تكون قيمة نوع الرأسية قماش او تصميم أو توصيل  ',
            'photo.required_without' => 'يجب ادخال صورة',
            'photo.mimes' => 'يجب ان تكون الصورة تحت صيغة jpg,jpeg,png',
        ];
    }
}
