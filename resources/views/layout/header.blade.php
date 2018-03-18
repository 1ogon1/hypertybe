<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>{{$title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ URL::asset('css/mycss.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<header class="header-fixed">

    <div class="header-limiter">

        <h1><a href="#">UNIT<span>HYPERTYBE</span></a></h1>

<!--        --><?php //$uri = Router::getURI();?>

        <nav>
            <?php if ($_SESSION['user_id']): ?>
            <a href="/profile/<?php echo $_SESSION['user_id'] ?>">My profile</a>
            <a href="/logout">Logout</a>
            <?php else: ?>
            <a href="/login">Login</a>
            <a href="/register">Register</a>
            <?php endif; ?>
        </nav>

    </div>

</header>

<div class="header-fixed-placeholder"></div>