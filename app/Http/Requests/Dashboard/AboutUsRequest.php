<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsRequest extends FormRequest
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
            'photo' => 'nullable|mimes:jpg,jpeg,png,mp4,ogx,oga,ogv,ogg,webm',
            'link' => 'nullable|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'about.required' => 'يرجى ادخال نبذة ',
            'about.max' => 'يجب ان لا يتجاوز اسم المنتج عن 500 حرف',
            'photo.required_without' => 'يجب ادخال صورة',
            'photo.mimes' => 'يجب ان تكون الصورة او الفيديو تحت صيغة jpg,jpeg,png,mp4,ogx,oga,ogv,ogg,webm',
            'link.string' => 'يجب ان يكون الرابط نص',
            'link.max' => 'يجب ان لا يتجاوز طول الرابط عن 1000 حرف',
        ];
    }
}
