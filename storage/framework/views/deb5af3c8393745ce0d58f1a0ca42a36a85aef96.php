<?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="row">
    <div class="col-sm-6">
        <h1>Востановление пароля</h1>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <form action="<?php echo e(route('resetpw')); ?>" method="post">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <div class="form-group">
                <label for="email">Email адресс</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                       placeholder="Введите email" required>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</div>

<?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>