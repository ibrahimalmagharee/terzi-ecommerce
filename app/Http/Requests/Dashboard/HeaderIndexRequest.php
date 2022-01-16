<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class HeaderIndexRequest extends FormRequest
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
            'header' => 'required|max:100',
            'description' => 'required|max:500',
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'header.required' => 'يرجى ادخال العنوان ',
            'header.max' => 'يجب ان لا يتجاوز العنوان عن 100 حرف',
            'description.required' => 'يرجى ادخال الوصف ',
            'description.max' => 'يجب ان لا يتجاوز الوصف عن 500 حرف',
            'photo.required_without' => 'يجب ادخال صورة',
            'photo.mimes' => 'يجب ان تكون الصورة تحت صيغة jpg,jpeg,png',
        ];
    }
}
