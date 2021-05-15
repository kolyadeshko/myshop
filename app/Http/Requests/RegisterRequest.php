<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // проверяем чтобы пользователь не был залогининым
        return !Auth::check();
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
                'min:7',
                'max:20',
                'unique:App\Models\User,username',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^[A-Za-z]/', $value)) {
                        $fail(
                            "Имя пользователя должно начинаться символов латинского алфавита",
                        );
                    } elseif (!preg_match('/^[A-Za-z0-9_]+$/', $value)) {
                        $fail(
                            "Имя пользователя должно состоять только из символов латинского алфавита, цифр и знака нижнего подчеркивания"
                        );
                    }
                }
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'unique:App\Models\User,email'
            ],
            'password' =>[
                'required',
                'min:7',
                'max:20',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^[A-Za-z0-9_]+$/', $value)) {
                        $fail(
                            "Пароль должен состоять только из символов латинского алфавита, цифр и знака нижнего подчеркивания"
                        );
                    }
                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Заполните поле :attribute'  ,
            'min' => 'Поле :attribute должно состоять не менее чем из :min символов',
            'max' => 'Поле :attribute должно состоять не более чем из :max символов'
        ];
    }
}
