$(document).ready(function () {

    if ($('#pattern').attr('data-page') == 1)
        $('#previous').hide();

    $('#search').click(function () {
        var params = {
            query_term: $('#input').val(),
            page: 1
        };
        getMovies(params);
        $('#pattern').attr('data-query_term', $('#input').val());
        return false;
    });

    $('#filterButton').click(function () {
        var params = {
            quality: $('#quality option:selected').text(),
            minimum_rating: $('#minimalRating option:selected').text(),
            genre: $('#genre option:selected').text(),
            query_term: $('#pattern').attr('data-query_term'),
            page: 1
        };
        $('#pattern').attr('data-sort', 'title');
        $('#previous').hide();
        $('#pattern').attr('data-quality', params.quality);
        $('#pattern').attr('data-minimum_rating', params.minimum_rating);
        $('#pattern').attr('data-genre', params.genre);
        getMovies(params);
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
        getMovies(params);
        return false;
    });

    $('#next').on('click', function () {

        var params = {
            page: parseInt($('#pattern').attr('data-page')) + 1,
            sort: $('#pattern').attr('data-sort'),
            order_by: $('#pattern').attr('data-order_by'),
            quality: $('#pattern').attr('data-quality'),
            minimum_rating: $('#pattern').attr('data-minimum_rating'),
            query_term: $('#pattern').attr('data-query_term'),
            genre: $('#pattern').attr('data-genre')
        };
        getMovies(params);
        if (params.page == $('#pattern').attr('data-page_count'))
            $('#next').hide();
        $('#previous').show();
        $('#previous').show();
    });

    $('#previous').click(function () {
        var params = {
            page: parseInt($('#pattern').attr('data-page')) - 1,
            sort: $('#pattern').attr('data-sort'),
            order_by: $('#pattern').attr('data-order_by'),
            quality: $('#pattern').attr('data-quality'),
            minimum_rating: $('#pattern').attr('data-minimum_rating'),
            query_term: $('#pattern').attr('data-query_term'),
            genre: $('#pattern').attr('data-genre')
        };
        getMovies(params);
        if (params.page == 1)
            $('#previous').hide();
        $('#next').show();
    });

    function getMovies(params) {

        $.get('api/get_movies', params, function (data) {
            $('ul.list').empty();
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
            if (parseInt($('#pattern').attr('data-page_count')) < parseInt($('#pattern').attr('data-page')))
                $('#next').hide();
            else
                $('#next').show();
        });
        if (params.page == 1)
            $('#previous').hide();
    }

})