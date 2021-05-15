<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        // получаем проверенные данные
        $userData = $request->validated();
        // регистрируем пользователя в бд
        $user = User::create($userData);
        $request->session()->flash(
            'message',
            "Пользователь с именем {$user->username}
            зарегистрирован. Авторизуйтесь для в форме ниже."

        );
        return redirect('/login');
    }
}
