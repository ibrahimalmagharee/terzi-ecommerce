<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
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
            'name' => 'required|max:100',
            'category_id' => 'required|numeric|exists:categories,id',
            'customer_id' => 'required|numeric|exists:customers,id',
            'chest_circumference' => 'required|numeric',
            'waistline' => 'required|numeric',
            'buttock_circumference' => 'required|numeric',
            'length_by_chest' => 'required|numeric',
            'chest_length' => 'required|numeric',
            'shoulder_length' => 'required|numeric',
            'back_view' => 'required|numeric',
            'neck_length' => 'required|numeric',
            'neck_width' => 'required|numeric',
            'neck_circumference' => 'required|numeric',
            'distance_between_breasts' => 'required|numeric',
            'arm_length' => 'required|numeric',
            'arm_circumference' => 'required|numeric',
            'armpit_length' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يرجى ادخال اسم المقاس',
            'name.max' => 'يجب ان لا يتجاوز اسم المقاس عن 100 حرف',
            'category_id.required' => 'يجب اختيار نوع القماش',
            'category_id.exist' => 'هذا النوع غير موجود',
            'category_id.numeric' => 'يجب ان تكون قيمة نوع القماش رقم',
            'customer_id.required' => 'يرجى تحديد العميل',
            'customer_id.exist' => 'هذا العميل غير موجود',
            'customer_id.numeric' => 'يجب ان تكون قيمة العميل رقم',
            'chest_circumference.required' => 'يرجى ادخال محيط الصدر',
            'chest_circumference.numeric' => 'يجب ان تكون قيمة محيط الصدر رقم',
            'waistline.required' => 'يرجى ادخال محيط الخصر',
            'waistline.numeric' => 'يجب ان تكون قيمة محيط الخصر رقم',
            'buttock_circumference.required' => 'يرجى ادخال محيط الأرداف',
            'buttock_circumference.numeric' => 'يجب ان تكون قيمة محيط الأرداف رقم',
            'length_by_chest.required' => 'يرجى ادخال طول بنسة الصدر ',
            'length_by_chest.numeric' => 'يجب ان تكون قيمة طول بنسة الصدر رقم',
            'chest_length.required' => 'يرجى ادخال طول الصدر',
            'chest_length.numeric' => 'يجب ان تكون قيمة طول الصدر رقم',
            'shoulder_length.required' => 'يرجى ادخال طول الكتف',
            'shoulder_length.numeric' => 'يجب ان تكون قيمة طول الكتف رقم',
            'back_view.required' => 'يرجى ادخال عرض الظهر',
            'back_view.numeric' => 'يجب ان تكون قيمة عرض الظهر رقم',
            'neck_length.required' => 'يرجى ادخال طول الرقبة',
            'neck_length.numeric' => 'يجب ان تكون قيمة طول الرقبة رقم',
            'neck_width.required' => 'يرجى ادخال عرض الرقبة',
            'neck_width.numeric' => 'يجب ان تكون قيمة عرض الرقبة رقم',
            'neck_circumference.required' => 'يرجى ادخال محيط الرقبة',
            'neck_circumference.numeric' => 'يجب ان تكون قيمة محيط الرقبة رقم',
            'distance_between_breasts.required' => 'يرجى ادخال المسافة بين الثديين',
            'distance_between_breasts.numeric' => 'يجب ان تكون قيمة المسافة بين الثديين رقم',
            'arm_length.required' => 'يرجى ادخال طول الذراع',
            'arm_length.numeric' => 'يجب ان تكون قيمة طول الذراع رقم',
            'arm_circumference.required' => 'يرجى ادخال محيط الذراع',
            'arm_circumference.numeric' => 'يجب ان تكون قيمة محيط الذراع رقم',
            'armpit_length.required' => 'يرجى ادخال طول حردة الابط ',
            'armpit_length.numeric' => 'يجب ان تكون قيمة طول حردة الابط رقم',


        ];
    }
}
