<?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="row filter">
    <div class="col-lg-4">
        <p>Genre:</p>
        <select name="" id="genre">
            <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($genre); ?>"><?php echo e($genre); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="col-lg-4">
        <p>Minimal rating:</p>
        <select name="" id="minimalRating">
            <?php for($i = 0; $i < 10; $i++): ?>
                <option value="<?php echo e($i); ?>"><?php echo e($i); ?>+</option>
            <?php endfor; ?>
        </select>
    </div>
    <div class="col-lg-4">
        <p>Quality:</p>
        <select class="custom-select" name="" id="quality">
            <?php $__currentLoopData = $qualitys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($quality); ?>"><?php echo e($quality); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <button id="filterButton" type="button" class="btn btn-primary">Search</button>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="input-group">
                <input id="input" type="text" class="form-control" placeholder="Search film">
                <div id="search" class="input-group-addon"><a href="">Search</a></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="filter">
            <p>Sort</p>
            <a class="sortButton" href="" data-sort="title">Title</a>
            <a class="sortButton" href="" data-sort="year">Year</a>
            <a class="sortButton" href="" data-sort="rating">Rating</a>
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
                        <a href="<?php echo e($movie['url']); ?>">
                            <img src="<?php echo e($movie['medium_cover_image']); ?>"/>
                        </a>
                    </div>
                    <div class="li-text">
                        <a href="<?php echo e($movie['url']); ?>">
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

<script>
    //    $(document).onload().scrollTop(0);
    $(document).ready(function () {
        $(this).scrollTop(0);
//        if ($('#pattern').attr('data-page') == 1)
//            $('#previous').hide();

        $("a[href='#top']").click(function () {
            $("html, body").animate({scrollTop: 0}, "slow");
            return false;
        });

        $('#search').click(function () {
            var params = {
                query_term: $('#input').val(),
                page: 1
            };
            getMovies(params, true);
            $('#pattern').attr('data-query_term', $('#input').val());
            return false;
        });

        $('#filterButton').click(function () {
            var params = {
                quality: $('#quality option:selected').val(),
                minimum_rating: $('#minimalRating option:selected').val(),
                genre: $('#genre option:selected').val(),
                query_term: $('#pattern').attr('data-query_term'),
                page: 1
            };
            $('#pattern').attr('data-sort', 'title');
//            $('#previous').hide();
            $('#pattern').attr('data-quality', params.quality);
            $('#pattern').attr('data-minimum_rating', params.minimum_rating);
            $('#pattern').attr('data-genre', params.genre);
            getMovies(params, true);
        });

        $('.sortButton').click(function () {
            if ($(this).attr('data-sort') === $('#pattern').attr('data-sort')) {
                if ($('#pattern').attr('data-order_by') === 'desc')
                    $('#pattern').attr('data-order_by', 'asc');
                else if ($('#pattern').attr('data-order_by') === 'asc')
                    $('#pattern').attr('data-order_by', 'desc');
            }

            var params = {
                page: $('#pattern').attr('data-page'),
                sort: $(this).attr('data-sort'),
                order_by: $('#pattern').attr('data-order_by'),
                quality: $('#pattern').attr('data-quality'),
                minimum_rating: $('#pattern').attr('data-minimum_rating'),
                query_term: $('#pattern').attr('data-query_term'),
                genre: $('#pattern').attr('data-genre')
            };
            $('#pattern').attr('data-sort', $(this).attr('data-sort'));
            getMovies(params, true);
            return false;
        });

//        $('#next').on('click', function () {
        function nextPage() {

            var params = {
                page: parseInt($('#pattern').attr('data-page')) + 1,
                sort: $('#pattern').attr('data-sort'),
                order_by: $('#pattern').attr('data-order_by'),
                quality: $('#pattern').attr('data-quality'),
                minimum_rating: $('#pattern').attr('data-minimum_rating'),
                query_term: $('#pattern').attr('data-query_term'),
                genre: $('#pattern').attr('data-genre')
            };
            getMovies(params, false);
//            if (params.page == $('#pattern').attr('data-page_count'))
//                $('#next').hide();
//            $('#previous').show();
//            $('#previous').show();
        }

//        });

        $(window).scroll(function () {
            if ($(window).scrollTop() > 300) {
                $('.to-top').css('display', 'block');
            }
            else {
                $('.to-top').css('display', 'none');

            }

            if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                $('.loader').css('display', 'block');
                nextPage();
            }
        });

//        $('#previous').click(function () {
//            var params = {
//                page: parseInt($('#pattern').attr('data-page')) - 1,
//                sort: $('#pattern').attr('data-sort'),
//                order_by: $('#pattern').attr('data-order_by'),
//                quality: $('#pattern').attr('data-quality'),
//                minimum_rating: $('#pattern').attr('data-minimum_rating'),
//                query_term: $('#pattern').attr('data-query_term'),
//                genre: $('#pattern').attr('data-genre')
//            };
//            getMovies(params);
//            if (params.page == 1)
//                $('#previous').hide();
//            $('#next').show();
//        });

        function getMovies(params, search) {

            $.get('api/get_movies', params, function (data) {
                if (search == true) {
                    $('ul.list').empty();
                }
                $('#pattern').data('page', params.page);
                $('#pattern').attr('data-page_count', data.data.movie_count / 12);
                $.each(data.data.movies, function (index, value) {
                    $('ul.list').append("            <li>\n" +
                        "                <a href=\"" + value.url + "/" + value.id + "\">\n" +
                        "                    <div class=\"li-img\">\n" +
                        "                        <img src=\"" + value.medium_cover_image + "\" />\n" +
                        "                    </div>\n" +
                        "                </a>\n" +
                        "                    <div class=\"li-text\">\n" +
                        "                        <a href=\"" + value.url + "\">\n" +
                        "                            <h4 class=\"li-head\">" + value.title + "</h4>\n" +
                        "                        </a>\n" +
                        "                        <p class=\"li-sub\">" + value.year + "</p>\n" +
                        "                        <p class=\"li-sub\">IMDb: " + value.rating + "</p>\n" +
                        "                    </div>\n" +
                        "            </li>");
                    $('#pattern').attr('data-page', params.page);
                });
                $('.loader').css('display', 'none');
//                if (parseInt($('#pattern').attr('data-page_count')) < parseInt($('#pattern').attr('data-page')))
//                    $('#next').hide();
//                else
//                    $('#next').show();
            });
//            if (params.page == 1)
//                $('#previous').hide();
        }

    })
</script>