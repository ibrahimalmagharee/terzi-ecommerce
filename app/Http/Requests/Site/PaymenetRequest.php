<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class PaymenetRequest extends FormRequest
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
            'nameCard' => 'required|max:150|min:1',
            'numberCard' => 'required|numeric|max:150|min:1',
            'mm' => 'required|numeric',
            'yy' => 'required|numeric',
            'cvv' => 'required|numeric',
        ];
    }
}
