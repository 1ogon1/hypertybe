<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Say hello!!</h1>

<img src="<?php echo e($user->image); ?>">
<p><?php echo e($user->name); ?> <?php echo e($user->surname); ?></p>
<p><?php echo e($user->email); ?></p>

<a href="/logout">logout</a>

</body>
</html>