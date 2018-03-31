<?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="row filter">
    <div class="col-lg-4">
        <p>Жанр:</p>
        <select name="" id="genre">
            <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($genre); ?>"><?php echo e($genre); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="col-lg-4">
        <p>Рейтинг:</p>
        <select name="" id="minimalRating">
            <?php for($i = 0; $i < 10; $i++): ?>
                <option value="<?php echo e($i); ?>"><?php echo e($i); ?>+</option>
            <?php endfor; ?>
        </select>
    </div>
    <div class="col-lg-4">
        <p>Качество:</p>
        <select class="custom-select" name="" id="quality">
            <?php $__currentLoopData = $qualitys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($quality); ?>"><?php echo e($quality); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="input-group">
                <input id="input" type="text" class="form-control" placeholder="Поиск фильма">
                <div id="search" class="input-group-addon"><a href="">Поиск</a></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="filter">
            <p>Сортировать</p>
            <a class="sortButton" href="" data-sort="title">Название</a>
            <a class="sortButton" href="" data-sort="year">Год</a>
            <a class="sortButton" href="" data-sort="rating">Рейтинг</a>
        </div>
    </div>
</div>

<div id="pattern" class="row pattern" data-page="<?php echo e($data['data']['page_number']); ?>" data-sort="<?php echo e($sort_by); ?>"
     data-page_count="<?php echo e($page_count); ?>" data-order_by="desc" data-quality="All" data-minimum_rating="0"
     data-genre="All" data-query_term="0">
    <div class="col-lg-12">
        <ul class="list img-list">
            <?php $__currentLoopData = $data['data']['movies']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <div class="li-img">
                        <a href="movies/<?php echo e($movie['id']); ?>">
                            <img src="<?php echo e($movie['medium_cover_image']); ?>"/>
                        </a>
                    </div>
                    <div class="li-text">
                        <a href="movies/<?php echo e($movie['id']); ?>">
                            <h4 class="li-head"><?php echo e($movie['title']); ?></h4>
                        </a>
                        <p class="li-sub"><?php echo e($movie['year']); ?></p>
                        <p class="li-sub">IMDb: <?php echo e($movie['rating']); ?></p>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12" style="height: 64px;">
        <div class="loader"></div>
    </div>
</div>
<a href="#top" class="to-top"></a>

<?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script src="<?php echo e(URL::asset('js/movie.js')); ?>" type="text/javascript"></script>