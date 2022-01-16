<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class FabricRequest extends FormRequest
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
            'colors' => 'required|array|min:1',
            'colors.*' => 'numeric|exists:colors,id',
            'category_id' => 'required|numeric|exists:categories,id',
            'description' => 'required|max:1000',
            'images' => 'required_without:id|min:1',
            'images.*' => 'string',
            'price' => 'required|numeric',
            'offer' => 'nullable|max:100',
            'vendor_id' => 'required|numeric|exists:vendors,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يرجى ادخال اسم المنتج',
            'name.max' => 'يجب ان لا يتجاوز اسم المنتج عن 100 حرف',
            'colors.required' => 'يجب اختيار لون المنتج',
            'colors.array' => 'يجب ان تكون الالوان في مصفوفة',
            'colors.min' => 'يجب اختيار لون واحد على الاقل',
            'colors.*.exist' => 'هذا اللون غير موجود',
            'colors.*.numeric' => 'يجب ان تكون قيمة اللون رقم',
            'colors.*.unique' => 'هذا اللون محجوز لهذا للمنتج من قبل',
            'category_id.required' => 'يجب اختيار قمسم للمنتج',
            'category_id.exist' => 'هذا القسم غير موجود',
            'category_id.numeric' => 'يجب ان تكون قيمة القسم رقم',
            'description.required' => 'يجب ادخال وصف للمنتج',
            'description.max' => 'يجب ان لا يتجاوز وصف المنتج عن 1000 كلمة',
            'images.required_without' => 'يجب ادخال صورة المنتج',
            'images.min' => 'يجب ادخال صورة واحدة على الاقل للمنتج',
            'images.*.string' => 'يجب ان تكون الصورة المخزنة نص',
            'price.required' => 'يحب ادخال سعر المنتج',
            'price.numeric' => 'يجب ان يكون السعر رقم',
            'offer.max' => 'يجب ان لا يتجاوز العرض عن 100 خانة',
            'vendor_id.required' => 'يجب اختيار التاجر لهذا المنتج',
            'vendor_id.exist' => 'هذا التاجر غير موجود',
            'vendor_id.numeric' => 'يجب ان تكون القيمة رقم',
        ];
    }
}
