@extends('layouts.app')
@section('title','Авторизация')
@section('content')
    <div class="auth">
        <div class="auth__container">
            <div class="auth__row">
                <div class="auth__title title1">
                    Авторизация
                </div>
                <div class="auth__body">
                    <div class="auth__form">
                        <form class="form" action="" method="post">
                            @csrf
                            <div class="form__item">
                                <label for="username" class="form__title title3">
                                    Имя пользователя :
                                </label>
                                <input value="{{ old('username') }}" id="username" name="username" class="form__input"
                                       type="text">
                                <div class="form__errors danger-text">
                                    @error('username')
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
                            <div class="form__item">
                                <label for="remember" class="form__title title3">
                                    Запомнить меня :
                                </label>
                                <input id="remember" type="checkbox" name="remember" class="form__checkbox">
                            </div>

                            <input type="submit" class="form__submit button">
                        </form>
                    </div>
                </div>
                <div class="additional-info">
                    <div class="title4">
                        Нет учетной записи?
                        <a href="/register" class="link">Зарегистрируйся</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

