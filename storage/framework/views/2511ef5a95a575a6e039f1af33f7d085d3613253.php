<?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    
    

    


    

    <div class="container">
        <div id="main">


            <div class="row" id="real-estates-detail">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <header class="panel-title">
                                <div class="text-center">
                                    <strong>Movie</strong>
                                </div>
                            </header>
                        </div>
                        <div class="panel-body">
                            <div class="text-center" id="author">
                                <img id="profilePhoto"
                                     src="<?php echo e($movieInfo['large_cover_image']); ?>">

                                <h3><?php echo e($movieInfo['title_english']); ?></h3>
                                <p><?php echo e($movieInfo['year']); ?></p>
                                <p>IMDb:
                                    <small class="label label-warning"><?php echo $movieInfo['rating'] ?></small>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-xs-12">
                    <div class="panel">
                        <div class="panel-body">

                            <div id="myTabContent" class="tab-content">
                                <hr>
                                <div class="tab-pane fade active in" id="detail">
                                    <!-- <h4>Movie information</h4> -->
                                    <table class="table">
                                        <tr>
                                        <th>Genres</th>
                                            <?php $__currentLoopData = $movieInfo['genres']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <td><?php echo e($genre); ?></td>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                        <tr>
                                            <th>Synopsis</th>
                                            <td><?php echo e($movieInfo['description_full']); ?></td>
                                        </tr>
                                    </table>
                                    <h4>Torrents</h4>
                                        <table class="table">
                                        <?php $__currentLoopData = $movieInfo['torrents']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $torrent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                            <th><a href="<?php echo e($torrent['url']); ?>"><?php echo e($torrent['quality']); ?></a></th>
                                            <td>Size: <?php echo e($torrent['size']); ?></td>
                                        </tr>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>

<?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>