$(document).ready(function () {
    $('#video-player-min').click(function () {
        if ($('#video-player-min').height() >= 18) {
            $('#video-player-min').animate({
                width: "400px",
                height: "300px",
                bottom: "50px",
                left: "50px"
            }, 500, function () {
                $('#video-player-min').addClass('my-fixed');
            });
        }

        if ($('#video-player-min').height() >= 250) {
            $('#video-player-min').animate({
                width: "150px",
                height: "20px"
            }, 500, function () {
                $('#video-player-min').removeClass('my-fixed');
            });

        }

    });
});