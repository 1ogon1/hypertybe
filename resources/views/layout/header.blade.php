<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{$title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta name="csrf-token" content="{{ Session::token() }}">

    {{--My css--}}
    <link rel="stylesheet" href="{{ URL::asset('css/mycss.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/movieinfo.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/hyper_player.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}">

    {{--Bootstrap css--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    {{--JQuery / Bootrstap js--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    {{--TRANSLATE--}}
    <script type="text/javascript">
       function googleTranslateElementInit() {
           new google.translate.TranslateElement({pageLanguage: 'en',includedLanguages: 'ru,en,fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
       }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 nopadding">
        <header class="header-fixed">
            <div class="header-limiter">
                <h1 class="notranslate"><a href="/">UNIT<span>HYPERTYBE</span></a></h1>
                <div id='google_translate_element'></div>
                <nav>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/profile/<?php echo $_SESSION['user_id'] ?>">
                        My profile
                    </a>
                    <a href="/logout">Logout</a>
                <?php else: ?>
                    <a href="/login">Login</a>
                    <a href="/register">Sign up</a>
                <?php endif; ?>
                </nav>
            </div>
        </header>
        </div>
        <div class="header-fixed-placeholder"></div>
    </div>
