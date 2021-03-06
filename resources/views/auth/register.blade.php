@extends('layouts.app')
@section('title','Регистрация')
@section('content')
    <div class="auth">
        <div class="auth__container">
            <div class="auth__row">
                <div class="auth__title title1">
                    Регистрация
                </div>
                <div class="auth__body">
                    <div class="auth__form">
                        <form class="form" action="" method="post">
                            @csrf
                            <div class="form__item">
                                <label for="username" class="form__title title3">
                                    Имя пользователя :
                                </label>
                                <input value="{{ old('username') }}" id="username" name="username" class="form__input" type="text">
                                <div class="form__errors danger-text">
                                    @error('username')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form__item">
                                <label for="email" class="form__title title3">
                                    Адрес электронной почты :
                                </label>
                                <input value="{{ old('email') }}" id="email" name="email" type="text" class="form__input">
                                <div class="form__errors danger-text">
                                    @error('email')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form__item">
                                <label for="password" class="form__title title3">
                                    Пароль :
                                </label>
                                <input id="password" type="password" name="password" class="form__input">
                                <div class="form__errors danger-text">
                                    @error('password')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <input type="submit" class="form__submit button">
                        </form>
                    </div>
                </div>
                <div class="additional-info">
                    <div class="title4">
                        Уже есть учетная запись?
                        <a href="/login" class="link">Войти</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
