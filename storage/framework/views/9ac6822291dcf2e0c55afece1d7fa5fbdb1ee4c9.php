<?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if(session('update')): ?>
    <div class="row">
        <div class="col-md-12 alert alert-info">
            <?php echo e(session('update')); ?>

        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <img src="<?php echo e($user->image); ?>" width="150" class="img-rounded">
        </div>
        <?php if($_SESSION['user_id'] == $user->id): ?>
            <form action="<?php echo e(route('update')); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <div class="form-group">
                    <div class="input-group">
                        <label class="input-group-btn">
                    <span class="btn btn-primary">
                        Choose&hellip; <input type="file" name="image" style="display: none;" accept="image/*">
                    </span>
                        </label>
                        <input type="text" class="form-control" readonly>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="name" class="form-control" value="<?php echo e($user->name); ?>" name="name" id="name"
                           aria-describedby="name"
                           placeholder="Enter name" required>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="surname" class="form-control" value="<?php echo e($user->surname); ?>" name="surname" id="surname"
                           aria-describedby="surname"
                           placeholder="Enter surname">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" value="<?php echo e($user->email); ?>" name="email" id="email"
                           aria-describedby="email"
                           placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="language">Choose language</label>
                    <select class="form-control" id="language" name="lang">
                        <option value="ru" <?php if($user->lang == "ru"): ?> selected <?php endif; ?>>Рус</option>
                        <option value="en" <?php if($user->lang == "en"): ?> selected <?php endif; ?>>Eng</option>
                        <option value="fr" <?php if($user->lang == "fr"): ?> selected <?php endif; ?>>Fra</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password"
                           aria-describedby="password"
                           placeholder="Enter password">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        <?php else: ?>
            <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="name" class="form-control" value="<?php echo e($user->name); ?>" name="name" id="name"
                       aria-describedby="name"
                       placeholder="Empty"
                       readonly>
            </div>
            <div class="form-group">
                <label for="surname">Surname</label>
                <input type="surname" class="form-control" value="<?php echo e($user->surname); ?>" name="surname" id="surname"
                       aria-describedby="surname"
                       placeholder="Emty"
                       readonly>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" value="<?php echo e($user->email); ?>" name="email" id="email"
                       aria-describedby="email"
                       placeholder="Empty"
                       readonly>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript" src="<?php echo e(URL::asset('js/userImage.js')); ?>"></script>