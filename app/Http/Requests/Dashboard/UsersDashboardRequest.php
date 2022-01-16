<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UsersDashboardRequest extends FormRequest
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
            'name' => 'required|max:100|min:1',
            'email' => 'required|max:100|email|unique:admins,email,'. $this -> id,
            'password' => 'required_without:id|confirmed|min:4|max:6',
            'role_id' => 'required|numeric|exists:roles,id',

        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'يرجى ادخال اسم المستخدم',
            'name.max' => 'يجب ان لا يتجاوز الاسم عن 100 حرف ',
            'name.min' => 'يجب ادخال حرف واحد على الاقل من اسم المستخدم ',
            'email.required' => 'يرجى ادخال البريد الالكتروني',
            'email.email' => 'يرجى التحقق من صيعة البريد الالكتروني المدخل',
            'email.unique' => 'هذا الايميل موجود من قبل يرجى التحقق من البريد الالكتروني االمدخل',
            'password.required_without' => 'يرجى ادخال كلمة المرور',
            'password.min' => 'كلمة المرور يجب ان لا تقل عن 4 أحرف',
            'password.max' => 'كلمة المرور يجب ان لا تزيد عن 6 احرف',
            'password.confirmed' => 'كلمة المرور غير متطابقة يرجى التأكد منها',
            'role_id.required' => 'يجب اختيار صلاحية هذا المستخدم',
            'role_id.numeric' => 'يجب ان تكون قيمة الصلاحية المخزنة رقم',
            'role_id.exists' => 'هذه الصلاحية غير موجودة',

        ];

    }
}
