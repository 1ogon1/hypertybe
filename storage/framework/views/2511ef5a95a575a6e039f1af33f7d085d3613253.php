<?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="row" id="real-estates-detail">
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <header class="panel-title">
                    <div class="text-center">
                        <strong><?php echo e($movieInfo['title_english']); ?></strong>
                    </div>
                </header>
            </div>
            <div class="panel-body">
                <div class="text-center" id="author">
                    <img id="profilePhoto" src="<?php echo e($movieInfo['large_cover_image']); ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <header class="panel-title">
                    <div class="text-center">
                        <strong>Детально</strong>
                    </div>
                </header>
            </div>
            <div class="panel-body">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="detail">
                        <div class="row">
                            <div class="col-sm-2 col-xs-2">
                                <b>Жанр:</b>
                            </div>
                            <div class="col-sm-10 col-xs-10">
                                <p>
                                    <?php $__currentLoopData = $movieInfo['genres']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span>
                                            <?php echo e($genre); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 col-xs-2">
                                <b>Описание:</b>
                            </div>
                            <div class="col-sm-10 col-xs-10">
                                <p><?php echo e($movieInfo['description_full']); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 col-xs-2">
                                <b>Год:</b>
                            </div>
                            <div class="col-sm-10 col-xs-10">
                                <p><?php echo e($movieInfo['year']); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 col-xs-2">
                                <b>IMDb:
                                </b>
                            </div>
                            <div class="col-sm-10 col-xs-10">
                                <p>
                                    <small class="label label-warning"><?php echo $movieInfo['rating'] ?></small>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p>
                                    <b>
                                        Скачать:
                                    </b>
                                </p>
                            </div>
                            <?php $__currentLoopData = $movieInfo['torrents']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $torrent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-2 col-xs-2 bottom">
                                    <a href="<?php echo e($torrent['url']); ?>">
                                        <?php echo e($torrent['quality']); ?>

                                    </a>
                                </div>
                                <div class="col-sm-10 col-xs-10 bottom">
                                    Объем: <?php echo e($torrent['size']); ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-1 col-sm-10">
        <div class="comment-list" id="comments">
            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="comment-block">
                    <div class="comment-name">
                        <a href="/profile/<?php echo e($comment->user_id); ?>">
                            <?php echo e($comment->name); ?> <?php echo e($comment->surname); ?>

                        </a>
                        <span>
                                <?php echo e($comment->created_at); ?>

                            </span>
                    </div>
                    <div class="comment-text">
                        <?php echo e($comment->comment); ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="panel panel-form">
            <div class="panel-body">
                <div >
                    <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="hidden" id="movie_id" name="movie_id" value="<?php echo e($movieInfo['id']); ?>">
                    <div class="form-group">
                        <label for="comment">Оставить коментарий</label>
                        <textarea class="form-control" rows="5" draggable="false" id="comment"
                                  name="comment"></textarea>
                    </div>
                    <button type="submit" id="comment_btn" class="btn btn-primary">Отправить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script src="<?php echo e(URL::asset('js/movieinfo.js')); ?>" type="text/javascript"></script>