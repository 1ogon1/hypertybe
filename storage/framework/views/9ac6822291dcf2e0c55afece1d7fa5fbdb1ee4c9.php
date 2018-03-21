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


<img src="<?php echo e($user->image); ?>" width="150">
<?php if($_SESSION['user_id'] == $user->id): ?>
<form action="<?php echo e(route('update')); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    <input type="file" name="image"><br>
    <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
    <input type="text" name="name" value="<?php echo e($user->name); ?>" placeholder="name"><br>
    <input type="text" name="surname" value="<?php echo e($user->surname); ?>" placeholder="surname"><br>
    <input type="email" name="email" value="<?php echo e($user->email); ?>" placeholder="email"><br>
    <input type="password" name="password" placeholder="new password"><br>
    <input type="submit" name="Submit">
</form>
<?php else: ?>
    <p><?php echo e($user->name); ?></p>
    <p><?php echo e($user->surname); ?></p>
    <p><?php echo e($user->email); ?></p>
<?php endif; ?>
<a href="/logout">logout</a>

</body>
</html>