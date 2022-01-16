<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'vendor_id' => 'required|numeric|exists:vendors,id',
            'code' => 'required|max:100',
            'type' => 'required|numeric|in:1,2',
            'percent_discount' => 'required|numeric',
            'start_datetime' => 'required|date_format:Y-m-d\TH:i|before_or_equal:end_datetime',
            'end_datetime' => 'required|date_format:Y-m-d\TH:i|after_or_equal:start_datetime',
        ];
    }

    public function messages()
    {
        return[
            'vendor_id.required' => 'يجب اختيار التاجر لهذا المنتج',
            'vendor_id.exist' => 'هذا التاجر غير موجود',
            'vendor_id.numeric' => 'يجب ان تكون القيمة رقم',
            'code.required' => 'يرجى ادخال الكود',
            'code.max' => 'يجب ان لا يتجاوز الكود عن 100 حرف او رقم او رمز ',
            'type.required' => 'يرجى اختيار نوغ الكوبون',
            'type.numeric' => 'يجب ان يكون نوع الكوبون رقم  ',
            'type.in' => 'يجب ان تكون قيمة نوع الكوبون نسبة او قيمة ثابتة  ',
            'percent_discount.required' => 'يرجى ادخال نسبة الخصم',
            'percent_discount.numeric' => 'يجب ان تكون نسبة الخصم رقم ',
            'start_datetime.required' => 'يرجى ادخال تاريخ بداية هذا الكوبون',
            //'start_datetime.date_format' => 'يجب ادخال تاريخ البداية بالصيغة الصحيحة ',
            'start_datetime.before_or_equal' => 'يجب ان لا يتجاوز تاريخ البداية تاريخ النهاية ',
            'end_datetime.required' => 'يرجى ادخال تاريخ نهاية هذا الكوبون',
            //'end_datetime.date_format' => 'يجب ادخال تاريخ النهاية بالصيغة الصحيحة ',
            'end_datetime.before_or_equal' => 'يجب ان يكون تاريخ النهاية اكبر من تاريخ البداية ',
        ];

    }
}
