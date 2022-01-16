<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class LogoRequest extends FormRequest
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
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'photo.required_without' => 'يجب ادخال صورة',
            'photo.mimes' => 'يجب ان تكون الصورة تحت صيغة jpg,jpeg,png',
        ];
    }
}
