<?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if(session('success')): ?>
    <div class="row">
        <div class="col-md-12 alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    </div>
<?php endif; ?>
<?php if(session('info')): ?>
    <div class="row">
        <div class="col-md-12 alert alert-info">
            <?php echo e(session('info')); ?>

        </div>
    </div>
<?php endif; ?>
<?php if(session('warning')): ?>
    <div class="row">
        <div class="col-md-12 alert alert-warning">
            <?php echo e(session('warning')); ?>

        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-sm-3">
        <form action="<?php echo e(route('signin')); ?>" method="post">
            <h1>Вход</h1>
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <div class="form-group">
                <label for="email">Email адресс</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                       placeholder="Введите email" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Пароль</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                       placeholder="Введите пароль" required>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
            <a href="/reset">Забыл пароль?</a>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-sm-3 login-with">
        <div class="row">
            <div class="col-sm-6">
                <p>Войти через</p>
            </div>
            <div class="col-sm-6">
<span class="intra">
<a href="https://api.intra.42.fr/oauth/authorize?client_id=ad0570aea500deeacfb27d1cb682999daa4c43b6b171ca99ff9ea2713562d4aa&redirect_uri=http%3A%2F%2Flocalhost%3A8080%2Fintralogin&response_type=code"
   class="">
<img src="https://signin.intra.42.fr/assets/42_logo_black-684989d43d629b3c0ff6fd7e1157ee04db9bb7a73fba8ec4e01543d650a1c607.png"
     alt="Intra 42 logo">
</a>
</span>
                <span class="fb">
<a href="<?php echo e($loginFb); ?>"><img src="<?php echo e(URL::asset('image/fb.ico')); ?>"></a>
</span>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>