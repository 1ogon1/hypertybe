$(document).ready(function () {
    $(this).scrollTop(0);
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
    }

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

    function getMovies(params, search) {

        $.get('api/get_movies', params, function (data) {
            if (search == true) {
                $('ul.list').empty();
            }
            $('#pattern').data('page', params.page);
            $('#pattern').attr('data-page_count', data.data.movie_count / 12);
            $.each(data.data.movies, function (index, value) {
                $('ul.list').append("            <li>\n" +
                    "                <a href=\"movies/" + value.id + "\">\n" +
                    "                    <div class=\"li-img\">\n" +
                    "                        <img src=\"" + value.medium_cover_image + "\" />\n" +
                    "                    </div>\n" +
                    "                </a>\n" +
                    "                    <div class=\"li-text\">\n" +
                    "                        <a href=\"movies/" + value.id + "\">\n" +
                    "                            <h4 class=\"li-head\">" + value.title + "</h4>\n" +
                    "                        </a>\n" +
                    "                        <p class=\"li-sub\">" + value.year + "</p>\n" +
                    "                        <p class=\"li-sub\">IMDb: " + value.rating + "</p>\n" +
                    "                    </div>\n" +
                    "            </li>");
                $('#pattern').attr('data-page', params.page);
            });
            $('.loader').css('display', 'none');
        });
    }

});