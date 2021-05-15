<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ! auth() -> check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => [
                'required',
                'exists:App\Models\User,username'
            ],
            'password' => [
                'required'
            ]
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Поле :attribute обзательное',
            'username.exists' => 'Пользователя с таким именем не существует'
        ];
    }
}