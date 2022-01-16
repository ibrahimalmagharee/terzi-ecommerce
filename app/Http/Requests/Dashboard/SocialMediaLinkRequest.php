<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaLinkRequest extends FormRequest
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
            'link' => 'required|max:2000',
        ];
    }

    public function messages()
    {
        return [
            'link.required' => 'يجب ادخال الرابط',
            'link.max' => 'يجب ان لا يتجاوز الرابط  عن 2000 حرف',
        ];
    }
}
