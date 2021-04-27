<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
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
                            <div class="header__links">
                                <div class="header__link-body">
                                    <a href="/" class="header__link">
                                        Главная

                                    </a>
                                </div>
                                <div class="header__link-body">
                                    <a href="/stocks" class="header__link">
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
                            <div class="header__categories">
                                ТУТ БУДУТ КАТЕГОРИИ
                            </div>
                            <div class="header__auth">
                                ||ЗДЕСЬ БУДЕТ АУТЕНТИФИКАЦИЯ
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
