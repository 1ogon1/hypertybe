<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?php echo e($title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="<?php echo e(URL::asset('css/mycss.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('css/movieinfo.css')); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <header class="header-fixed">
            <div class="header-limiter">
                <h1><a href="/">UNIT<span>HYPERTYBE</span></a></h1>
                <nav>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/profile/<?php echo $_SESSION['user_id'] ?>">
                        <img >
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