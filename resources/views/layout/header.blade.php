<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>{{$title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="{{ URL::asset('css/mycss.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/movieinfo.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    {{--<script type=“text/javascript” src=“{{URL::asset('js/translate.js')}}”></script>--}}

    <script type="text/javascript">
       function googleTranslateElementInit() {
           var laang = 'en';
//           new google.translate.TranslateElement({pageLanguage: 'ru',includedLanguages: 'ru,en,fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
           new google.translate.TranslateElement({pageLanguage: 'ru',includedLanguages: 'ru,en,fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
       }
   </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<body>
<div class="container-fluid">
    <div class="row">
        <header class="header-fixed">
            <div class="header-limiter notranslate">
                <h1><a href="/">UNIT<span>HYPERTYBE</span></a></h1>
                <div id='google_translate_element'></div>
                <nav>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/profile/<?php echo $_SESSION['user_id'] ?>">
                        Мой профиль
                    </a>
                    <a href="/logout">Выход</a>
                <?php else: ?>
                    <a href="/login">Вход</a>
                    <a href="/register">Регистрация</a>
                <?php endif; ?>
                </nav>
            </div>
        </header>
        <div class="header-fixed-placeholder"></div>
    </div>
