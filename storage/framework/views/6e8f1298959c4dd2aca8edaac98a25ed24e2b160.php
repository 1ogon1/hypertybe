<div class="row fixed-bottom">
    <div class="col-sm-12 nopadding">
        <div class="row">
            <?php if (isset($_SESSION['user_id'])): ?>
            <div class="col-sm-2">
                <div class="video-player-min" id="video-player-min">
                    <p>Drop me player...</p>
                </div>
            </div>
            <div class="col-sm-10">
                <footer class="footer-basic-centered">
                    <p class="footer-company-motto notranslate">UNIT Factory</p>
                    <p class="footer-company-name notranslate">rkonoval, vrudenko, vrybchc, mpotapov &copy; 2018</p>
                </footer>
            </div>
            <?php else: ?>
            <div class="col-sm-12">
                <footer class="footer-basic-centered">
                    <p class="footer-company-motto notranslate">UNIT Factory</p>
                    <p class="footer-company-name notranslate">rkonoval, vrudenko, vrybchc, mpotapov &copy; 2018</p>
                </footer>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo e(URL::asset('js/video-player-min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/jquery-1.12.4.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/jquery-ui.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/HyperPlayer_module.js')); ?>"></script>

<script defer="defer">
    var folder = "YouTube Folde Name/";

    HyperPlayer.dataFromFolder('movies/'+folder, $('.video-panel'));
</script>