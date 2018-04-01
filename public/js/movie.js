$(document).ready(function () {
    $(this).scrollTop(0);
    $("a[href='#top']").click(function () {
        $("html, body").animate({scrollTop: 0}, "slow");
        return false;
    });

    $('#search').click(function () {
        var params = {
            quality: $('#quality option:selected').val(),
            minimum_rating: $('#minimalRating option:selected').val(),
            genre: $('#genre option:selected').val(),
            query_term: $('#input').val(),
            page: 1
        };
        getMovies(params, true);
        $('#pattern').attr('data-query_term', $('#input').val());


        $('#pattern').attr('data-sort', 'title');
        $('#pattern').attr('data-quality', params.quality);
        $('#pattern').attr('data-minimum_rating', params.minimum_rating);
        $('#pattern').attr('data-genre', params.genre);


        return false;
    });

    // $('#filterButton').click(function () {
    //     var params = {
    //         quality: $('#quality option:selected').val(),
    //         minimum_rating: $('#minimalRating option:selected').val(),
    //         genre: $('#genre option:selected').val(),
    //         query_term: $('#pattern').attr('data-query_term'),
    //         page: 1
    //     };
    //     $('#pattern').attr('data-sort', 'title');
    //     $('#pattern').attr('data-quality', params.quality);
    //     $('#pattern').attr('data-minimum_rating', params.minimum_rating);
    //     $('#pattern').attr('data-genre', params.genre);
    //     getMovies(params, true);
    // });

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

var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    /*for each element, create a new DIV that will act as the selected item:*/
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);
    /*for each element, create a new DIV that will contain the option list:*/
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 1; j < selElmnt.length; j++) {
        /*for each option in the original select element,
        create a new DIV that will act as an option item:*/
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;
        c.addEventListener("click", function(e) {
            /*when an item is clicked, update the original select box,
            and the selected item:*/
            var i, s, h;
            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
            h = this.parentNode.previousSibling;
            for (i = 0; i < s.length; i++) {
                if (s.options[i].innerHTML == this.innerHTML) {
                    s.selectedIndex = i;
                    h.innerHTML = this.innerHTML;
                    break;
                }
            }
            h.click();
        });
        b.appendChild(c);
    }
    x[i].appendChild(b);
    a.addEventListener("click", function(e) {
        /*when the select box is clicked, close any other select boxes,
        and open/close the current select box:*/
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
    /*a function that will close all select boxes in the document,
    except the current select box:*/
    var x, y, i, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    for (i = 0; i < y.length; i++) {
        if (elmnt == y[i]) {
            arrNo.push(i)
        } else {
            y[i].classList.remove("select-arrow-active");
        }
    }
    for (i = 0; i < x.length; i++) {
        if (arrNo.indexOf(i)) {
            x[i].classList.add("select-hide");
        }
    }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);