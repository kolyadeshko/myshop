@extends('layouts.app')
@section('title','Регистрация')
@section('content')
    <div class="register">
        <div class="register__container">
            <div class="register__row">
                <div class="register__title title1">
                    Регистрация
                </div>
                <div class="register__body">
                    <div class="register__form">
                        <form class="form" action="" method="post">
                            @csrf
                            <div class="form__item">
                                <label for="username" class="form__title title3">
                                    Имя пользователя :
                                </label>
                                <input value="{{ old('username') }}" id="username" name="username" class="form__input" type="text">
                                <div class="form__errors">
                                    @error('username')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form__item">
                                <label for="email" class="form__title title3">
                                    Адрес электронной почты :
                                </label>
                                <input value="{{ old('email') }}" id="email" name="email" type="email" class="form__input">
                                <div class="form__errors">
                                    @error('password')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form__item">
                                <label for="password" class="form__title title3">
                                    Пароль :
                                </label>
                                <input value="{{ old('password') }}" id="password" type="password" name="password" class="form__input">
                                <div class="form__errors">
                                    @error('username')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <input type="submit" class="form__submit button">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
