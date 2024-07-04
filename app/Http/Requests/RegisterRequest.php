<?php

namespace App\Http\Requests;

use App\Models\Account;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
                'required'
            ],
            'address' => [
                'required'
            ],
            'username' => [
                'required'
            ],
            'password' => [
                'required'
            ],
            'email' => [
                Rule::unique(Account::class,'email')
            ]
        ];
    }
}
