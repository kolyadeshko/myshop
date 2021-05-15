<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $formFields = $request -> only(['username','password']);
        $remember = $request -> input('remember');

        if (Auth::attempt($formFields,$remember))
        {
            return redirect() -> intended(route('mainpage'));
        }else{
            return redirect('/login') -> withErrors(
                [
                    'password' => 'Пароль указано неверно'
                ]
            );
        }
    }
}
