<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'numeric|exists:permissions,id',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'يرجى ادخال اسم الصلاحية',
            'name.max' => 'يجب ان لا يتجاوز الاسم عن 100 حرف ',
            'name.min' => 'يجب ادخال حرف واحد على الاقل من اسم المستخدم ',
            'permissions.required' => 'يجب اختيار قيود هذه الصلاحية',
            'permissions.array' => 'يجب ان تكون القيود علر شكل مصفوفة',
            'permissions.min' => 'يجب اختيار قيد واحد على الأقل',

        ];

    }
}
