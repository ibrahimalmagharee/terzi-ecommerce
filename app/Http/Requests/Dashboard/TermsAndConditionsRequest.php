<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class TermsAndConditionsRequest extends FormRequest
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
            'description' => 'required|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'يرجى ادخال الشروط و الأحكام',
            'description.max' => 'يجب ان لا تتجاوز الشروط و الأحكام عن 5000 حرف',
        ];
    }
}
