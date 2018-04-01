$(document).ready(function () {
    $('#comment_btn').click(function () {
        var params = {
            _token: $('#_token').val(),
            comment: $('#comment').val(),
            movie_id: $('#movie_id').val()
        };
        $.post('/addcomment', params, function (data) {
            data = JSON.parse(data);
            if (data.type == "success") {
                console.log(data);
                $('#comments').prepend(
                    '<div class="comment-block">' +
                        '<div class="comment-name">' +
                            '<a href="/profile/' + data.user_id + '">' +
                                data.user_name + ' ' + data.user_surname +
                            '</a>' +
                            '<span>' +
                                data.created_at.date.split('.')[0] +
                            '</span>' +
                        '</div>' +
                        '<div class="comment-text">' +
                            data.comment +
                        '</div>' +
                    '</div>'
                );
                $('#comment').val("");
            }
        })
    });
});