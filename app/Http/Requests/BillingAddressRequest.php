<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingAddressRequest extends FormRequest
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
            'fullname' => [
                'required',
                'max:255'
            ],
            'address' => [
                'required',
                'max:255'
            ],
            'phone' => [
                'numeric',
                // 'max:15'
            ]
        ];
    }
}
