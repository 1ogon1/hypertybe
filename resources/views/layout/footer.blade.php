<div class="row fixed-bottom">
    <div class="col-sm-12 nopadding">
        <div class="row">
            <div class="col-sm-12">
                <div class="orange" style="width: 0; height: 0; background: orange"></div>
                <footer class="footer-basic-centered">
                    <p class="footer-company-motto notranslate">UNIT Factory</p>
                    <p class="footer-company-name notranslate">rkonoval, vrudenko, vrybchc, mpotapov &copy; 2018</p>
                </footer>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="{{URL::asset('js/video-player-min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/jquery-1.12.4.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/HyperPlayer_module.js')}}"></script>

<script defer="defer">

    if ($(window).width() > 500) {


        <?php if (isset($_SESSION['movie_folder'])) : ?>

            HyperPlayer.dataFromFolder('public/movies/<?php echo $_SESSION['movie_folder']?>', $('.orange'), 1);
            $('.preload-page').css('display', 'none');

        <?php endif; ?>

        var video_panel_h = $('.video-panel').width() / 100 * 56.25;
        $('.video-panel').css('height', video_panel_h);

        $( window ).resize(function() {
            var video_panel_h = $('.video-panel').width() / 100 * 56.25;
            $('.video-panel').css('height', video_panel_h);
        });
    }

</script>