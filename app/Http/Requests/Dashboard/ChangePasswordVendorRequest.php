<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordVendorRequest extends FormRequest
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
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:4|max:6',
        ];
    }

    public function messages()
    {
        return[
            'old_password.required' => 'يجب ادخال كلمة المرور القديمة',
            'new_password.required' => 'يجب ادخال كلمة المرور الجديدة',
            'new_password.min' => 'كلمة المرور يجب ان لا تقل عن 4 أحرف',
            'new_password.max' => 'كلمة المرور يجب ان لا تزيد عن 6 احرف',
            'new_password.confirmed' => 'كلمة المرور غير متطابقة يرجى التأكد منها',
        ];

    }
}
