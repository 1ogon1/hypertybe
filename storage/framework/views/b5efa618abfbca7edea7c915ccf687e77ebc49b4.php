<?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if(session('error')): ?>
    <div class="row">
        <div class="col-md-12 alert alert-danger">
            <span class="">
                <?php echo session('error'); ?>

            </span>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-md-3">
        <form action="<?php echo e(route('signup')); ?>" method="post">
            <h1>Registration</h1>
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="name" class="form-control" name="name" id="name" aria-describedby="name"
                       placeholder="Enter name" required>
            </div>
            <div class="form-group">
                <label for="surname">Surname</label>
                <input type="surname" class="form-control" name="surname" id="surname" aria-describedby="surname"
                       placeholder="Enter surname" required>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="email"
                       placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="password"
                       placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>