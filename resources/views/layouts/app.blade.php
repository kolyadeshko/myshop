<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
</head>
<body>
<div id="app">
    <div class="app__container">
        <div class="app__header">
            <div class="header">
                <div class="header__container">
                    <div class="header__row">
                        <a href="/" class="header__logo">
                            <img src="/img/shop.png" alt="">
                        </a>
                        <div class="header__body">
                            <div class="header__categories">
                                <product-types/>
                            </div>
                            <div class="header__links">
                                <div class="header__link-body">
                                    <a href="/" class="header__link">
                                        Главная

                                    </a>
                                </div>
                                <div class="header__link-body">
                                    <a href="/promotion-products" class="header__link">
                                        Акции %
                                    </a>
                                </div>
                                <div class="header__link-body">
                                    <a href="/addition" class="header__link">Дополнительно</a>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown__link">
                                            Контакты
                                        </a>
                                        <a href="#" class="dropdown__link">
                                            Вакансии
                                        </a>
                                        <a href="#" class="dropdown__link">
                                            Отзывы и предложения
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="header__auth">
                                @auth
                                    <div class="header__user">
                                        <div class="header__link-body">
                                            <img class="user-img" src="/img/user-ico.png" alt=""><a href="{{ '/user/' . auth() -> user() -> username }}" class="header__link">{{ auth() -> user() -> username }}</a>
                                            <div class="dropdown">
                                                <a href="/shopping-cart" class="dropdown__link">
                                                    Корзина
                                                </a>
                                                <a href="/logout" class="dropdown__link">
                                                    Выйти из аккаунта
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endauth
                                @guest
                                    <div class="auth-links">
                                        <a href="/register" class="auth-links__item">
                                            Регистрация
                                        </a>
                                        <a href="/login" class="auth-links__item">
                                            Авторизация
                                        </a>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app__message">
            @if(session() -> has('message'))
                <message :text="`{{ session() -> get('message') }}`"></message>
            @endif
        </div>
        <div class="content">
            @yield('content')
        </div>
        <div class="app__footer">
            <div class="footer">
                <div class="footer__container">
                    <div class="footer__row">
                        <div class="footer__social-links">
                            <social-links></social-links>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ mix("/js/app.js") }}"></script>
</body>
</html>
