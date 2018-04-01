var HyperPlayer = (function () {
    var flag_click = 1;

    // var php_script_patch = 'http://localhost:8080/Hypertube/php/find_movie_n_sub.php';  // путь скрипа по поиску данных о фильме
    var php_script_patch = '/findmovie';  // путь скрипа по поиску данных о фильме
    // var php_script_size_path = 'http://localhost:8080/Hypertube/php/filesize.php';
    var php_script_size_path = '/filesize';
    // var movie_folder_path = 'http://localhost:8080/Hypertube/Movie';
    var movie_folder_path = '/storage/';

    var movie_folder = '';
    var full_movie_name = '';
    var movie_size = 0;
    var movie_titles = '';
    var p_container;
    var movie_name = '';

    var current_time = 0;
    var line_percent = 0;
    var title_flag = 0;

    var video_downloaded = 0;
    var player_created_flag = 0;
    var my_cont = 0;



    var dragable_part;
    var video;
    var player_container;
    var resizible;
    var fullscreen_btn;
    var full_s_btn;
    var timeline;

    var subtitleEn;
    var currentTitleId = 0;
    var currentTitleText = "";

    var last_volume = 100;
    var titles_display = 0;


    var progress_flag = 0;
    var source_progress = 0;
    var play_flag = 0;


    var SizeRequest;


    var unpin_btn;


    var secondsTimeSpanToHMS =  function(s) {
        var h = Math.floor(s/3600); //Get whole hours
        s -= h*3600;
        var m = Math.floor(s/60); //Get remaining minutes
        s -= m*60;
        s = Math.round(s);
        return h+":"+(m < 10 ? '0'+m : m)+":"+(s < 10? '0'+s : s); //zero padding on minutes and seconds
    };

    function loadVideo(id)
    {
        var video = document.getElementById('video');
        var mp4 = document.getElementById('video-source-id');
        d = new Date();

      //  mp4.src =  id;

         mp4.src =  id + "?time=" + d.getTime();
        document.getElementById("video").load();

        // mp4.src =  id;
        // video.load();


        // video.play();
    }




    var timelineFunc = function () {

        document.getElementById("video").onloadeddata = function() {
            $('.current-film-time').html(('0:00:00'));

            $('.film-duration').html(secondsTimeSpanToHMS(document.getElementById("video").duration));
        };


        document.getElementById("video").ontimeupdate = function() {
            // console.log(document.getElementById("video").currentTime);
            // console.log('***  6| ontimeupdate ****');

            if (title_flag === 0 && typeof(movie_titles) !== "undefined" && video_downloaded > 5 ) {
                     parseSubtitle(movie_titles);

                     console.log('type 1 = ' + typeof(subtitleEn));
                    if ( typeof(subtitleEn) !== "undefined") {
                        $('.sub-btn').css('display', 'block');
                        title_flag = 1;
                    }
                }


            video = document.getElementById("video");

            // console.log(subtitleEn.length);
            if (title_flag === 1) {
                if (subtitleEn.length > 0) {
                    while ( video.currentTime > subtitleEn[currentTitleId].end ) {
                        currentTitleId++;
                    }

                    if (video.currentTime >= subtitleEn[currentTitleId].start && video.currentTime <= subtitleEn[currentTitleId].end) {
                        if (currentTitleText !== subtitleEn[currentTitleId].text) {
                            currentTitleText = subtitleEn[currentTitleId].text;
                            console.log(currentTitleText);
                            $('.title-div').html(currentTitleText);
                        }
                    } else {
                        $('.title-div').html('');
                    }
                }
            }



            // console.log('*Line percen = ' + line_percent);
            // console.log('*video downloaded = ' + video_downloaded);

            if (line_percent > (video_downloaded - 2)) {
                line_percent = video_downloaded - 2;
            }


            if (document.getElementById("video").currentTime === document.getElementById("video").duration) {
                loadVideo(full_movie_name);
            }

            if ( (line_percent >= (video_downloaded - 2)) && video_downloaded < 100 ) {
                // document.getElementById("video").load();
                loadVideo(full_movie_name);
                pauseVideo();
                line_percent = video_downloaded - 2;
                var tmp = secondsTimeSpanToHMS( (line_percent * document.getElementById("video").duration / 100 ));
                if (tmp < 0 || isNaN(tmp)) {
                    document.getElementById("video").currentTime = 0;
                } else {
                    document.getElementById("video").currentTime = tmp;

                }
            } else {
                if ( (source_progress)  <= line_percent) {

                    // alert('source progress = ' + source_progress);
                    // alert('line percent = ' + line_percent);


                    if ((document.getElementById("video").currentTime * 100 / document.getElementById("video").duration + 2) >= video_downloaded) {
                        pauseVideo();
                    }


                    var tmp2 = document.getElementById("video").duration * line_percent / 100;
                    if (isNaN(tmp)) {
                        document.getElementById("video").currentTime = 0;
                    } else {
                        vidocument.getElementById("video").currentTime = tmp;
                    }


                    if (document.getElementById("video").paused) {
                        play_flag = 0;
                    } else {
                        play_flag = 1;
                    }
                    current_time = document.getElementById("video").currentTime;

                    // alert('video downloaded = ' + video_downloaded);
                    if (video_downloaded < 100) {
                        // alert('should load');
                        // if ( video.readyState === 4 ) {
                        //     it's loaded
                        // alert('LOADED');
                        console.log('RELOAD WIDEO. current_progress[' + secondsTimeSpanToHMS(source_progress * document.getElementById("video").duration / 100) + ']. Next progress [' + secondsTimeSpanToHMS((video_downloaded - 2) * document.getElementById("video").duration / 100) + ']');
                        source_progress = video_downloaded - 2;
                        document.getElementById("video-source-id").src = full_movie_name;
                        // document.getElementById("video").load();
                        loadVideo(full_movie_name);


                        // }
                    }

                    document.getElementById("video").currentTime = current_time;
                    if (play_flag === 1 /* &&  video_downloaded < 100 */) {
                        playVideo();
                    }
                }

            }

            // if (video.currentTime > 0) {
            // console.log('video DURATION = ' +video.duration);
            // console.log('!!!!! CURRENT TIME = ' +  video.currentTime);
                line_percent = document.getElementById("video").currentTime * 100  / document.getElementById("video").duration;
            // }

            // if (source_progress <= line_percent) {
            //     if (line_percent >= video_downloaded) {
            //         pauseVideo();
            //         return;
            //     }
            //     if (video.paused) {
            //         play_flag = 0;
            //     } else {
            //         play_flag = 1;
            //     }
            //     current_time = video.currentTime;
            //     video.load();
            //     progress_flag = 0;
            //     video.currentTime = current_time;
            //     if (play_flag === 1 && video_downloaded < 100) {
            //         playVideo();
            //     }
            // }




            if ( (line_percent < video_downloaded - 2) || video_downloaded >= 100) {
                $('.time-cursor').css('width', line_percent + "%");
                if ( !isNaN(document.getElementById("video").duration) ) {
                    $('.current-film-time').html(  secondsTimeSpanToHMS(document.getElementById("video").duration * line_percent / 100) );
                }
            }
        };


        timeline.on('click', function(e) {
            console.log('***** 7| click on timeline  *****');
            // alert('clicl on timelime');
            var x = e.offsetX==undefined?e.layerX:e.offsetX;

            line_percent = x * 100  / timeline.width();
            console.log('***** 7| line percent clicked = ' + line_percent);


            document.getElementById("video").currentTime = document.getElementById("video").duration * line_percent / 100;

            currentTitleId = 0;
        });

        timeline.hover(
            function() {
                $('.hover-time').fadeIn( 200 );
            }, function() {
                $('.hover-time').fadeOut( 200 );
            }
        );


        timeline.on('mousemove', function(e) {
            var x = e.offsetX==undefined?e.layerX:e.offsetX;

            var percent_position = x * 100  / timeline.width();
            var current_time = secondsTimeSpanToHMS(document.getElementById("video").duration * percent_position / 100);

            $('.hover-time').css('left', percent_position + '%').html(current_time);
        });
    };

    // draggable player

    function dragElement(elmnt) {

        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        if (document.getElementById(elmnt.id + "header")) {
            /* if present, the header is where you move the DIV from:*/
            document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
        } else {
            /* otherwise, move the DIV from anywhere inside the DIV:*/
            elmnt.onmousedown = dragMouseDown;
        }


        function dragMouseDown(e) {
            if ($('.unpin-btn').hasClass('unpinned-btn')) {

                e = e || window.event;
                // get the mouse cursor position at startup:
                pos3 = e.clientX;
                pos4 = e.clientY;
                document.onmouseup = closeDragElement;
                // call a function whenever the cursor moves:
                document.onmousemove = elementDrag;
            }
        }

        function elementDrag(e) {
            e = e || window.event;
            // calculate the new cursor position:
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            // set the element's new position:
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";

            // console.log(flag_click);
            flag_click = 0;
        }

        function closeDragElement() {
            /* stop moving when mouse button is released:*/
            document.onmouseup = null;
            document.onmousemove = null;
            // console.log('dragged');
        }
    }



    var HMStoseconds = function(hms) {
        var a = hms.split(':');
        var seconds;

        seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);

        return seconds;
    };

    var parseSubtitle = function (url) {
        //define variable type - Array
        var subtitles = [];
        jQuery.get(url, function(data) {


            function strip(s) {
                if (typeof (s) === 'undefined')
                {
                    return '';
                }
                return s.replace(/^\s+|\s+$/g,"");
            }
            srt = data.replace(/\r\n|\r|\n/g, '\n');

            if (srt === '') {
                return '';
            }
            srt = strip(srt);

            var srt_ = srt.split('\n\n');

            var cont = 0;

            var time;

            for(s in srt_) {
                st = srt_[s].split('\n');

                if(st.length >=2) {
                    n = st[0];

                    i = strip(st[1].split(' --> ')[0]);
                    time = i.replace(',', '.');
                    i = HMStoseconds(time);

                    o = strip(st[1].split(' --> ')[1]);
                    time = o.replace(',', '.');
                    o = HMStoseconds(time);

                    t = st[2];

                    if(st.length > 2) {
                        for(j=3; j<st.length;j++)
                            t += '\n'+st[j];
                    }

                    //define variable type as Object
                    subtitles[cont] = {};
                    subtitles[cont].number = n;
                    subtitles[cont].start = i;
                    subtitles[cont].end = o;
                    subtitles[cont].text = t;

                }
                cont++;
            }
            subtitleEn = subtitles;

        });

        // return subtitles;
        };

    function create_player_div(callback) {
        console.log('***** 5| create_player_div *****');
        var html_player = ' <div id="mydiv" class="vr-player-container">\n' +
            '                <div id="resizable" class="ui-widget-content">\n' +
            '                <input id="mydivheader" readonly>\n' +
            '                </input>\n' +
            '                    <div class="top-left-bar">\n' +
            '                     \n' +
            '                        <div id="slider"></div>\n' +
            '\n' +
            '\n' +
            '                    </div>\n' +
            '\n' +
            '                    <div class="top-right-bar">\n' +
            '                        <div class="sub-btn"></div>\n' +
            '                        <div class="save-btn"></div>\n' +
            '                        <div class="unpin-btn"></div>\n' +
            '                        <div class="full-screen-btn"></div>\n' +
            '                    </div>\n' +
            '\n' +
            '                        <!--<div class="title-outer"><div class="title-div notranslate"></div></div>-->\n' +
            '                    <div class="title-outer"><div class="title-div notranslate"></div></div>\n' +
            '\n' +
            '\n' +
            '\n' +
            '                    <div class="bottom-bar-outer">\n' +
            '                        <div class="hover-time notranslate">0:00:00</div>\n' +
            '                    <div class="bottom-panel-border-lt">\n' +
            '                    </div>\n' +
            '                    <div class="bottom-panel-border-lb">\n' +
            '                       <div class="play-btn"></div>\n' +
            '                    </div>\n' +
            '                    <div class="bottom-panel-border-rt">\n' +
            '                    </div>\n' +
            '' +
            '' +
            '                    <div class="bottom-panel-border-rb">\n' +
            '                           <input id="vol-control" type="range" min="0" max="100" step="1" value="100" oninput="SetVolume(this.value)" onchange="SetVolume(this.value)"></input>\n' +

            '                       <div class="volume-btn">' +
            '</div>\n' +
            '                    </div>\n' +

            '                    <div class="bottom-bar">\n' +
                '                        <div class="time-cursor"></div>\n' +
                '                        <div class="time-info">\n' +
                '                            <span class="current-film-time notranslate"></span> / <span class="film-duration"></span>\n' +
                '                        </div>\n' +
                '\n' +
                '                        <div id="timeline"></div>\n' +
                '                        <div id="redline"></div>\n' +
                '\n' +
                '                    </div>\n' +
            '                    </div>\n' +

            '\n' +
            '\n' +
            '                    <video id="video"  style="width: 100%; height: 100%"  onclick="PlayPauseVideo()" >\n' +
            '\n' +
            '                        <source class="video-source" id="video-source-id" src="{{URL::asset(\'' + full_movie_name + '\')}}" type="video/mp4">\n' +
            '\n' +
            '                    </video>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '' +
            '' +
            '' +
            '<script>\n' +
            '                function SetVolume(val)\n' +
            '                {\n' +
            '                    var player = document.getElementById(\'video\');\n' +
            '                    player.volume = val / 100;\n' +
            '\n' +
            '                    if (player.volume === 0 ){\n' +
            '                        $(\'.volume-btn\').addClass(\'volume-zero-btn\');\n' +
            '                    }\n' +
            '                    else {\n' +
            '                        $(\'.volume-btn\').removeClass(\'volume-zero-btn\');\n' +
            '                    }\n' +
            '                }\n' +
            '            </script>' +
            '' +
            '' +
            '\n';

        p_container.empty();
        p_container.append(html_player);

        callback();
        console.log('***** 5| create_player_div *****');
    }

    var initPlayer = function (mv_name, mv_subt_name, container) {
        console.log('***** 4| initPlayer [in] *****');


        // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!link to download video

        full_movie_name =  movie_folder_path  + mv_name.replace(/ /g, '%20').replace('public/', '');



        console.log('0) ' + full_movie_name);


        console.log('1) ' + movie_folder_path);
        console.log('2) ' + movie_folder);
        console.log('3) ' + mv_name);


        //  alert(full_movie_name);
        console.log('4| movie path: ' + full_movie_name);

        // alert('0' + mv_subt_name);
        if (typeof (mv_subt_name) !==  'undefined') {
            // !!!!!!!!!!!!!!!!!!!!!!!! link to download titles
            movie_titles =  movie_folder_path + '/' + movie_folder.replace(/ /g, '%20') + '/' + mv_subt_name.replace(/ /g, '%20');
            console.log('4| movie title path: ' + movie_titles);
        }

        console.log('4| calling html player constructor');
        create_player_div(function () {
            console.log('****** 5| callback after player creationg *****');
            video = document.getElementById("video");
            dragElement(document.getElementById(("mydiv")));


            //***************************************************
            unpin_btn = $('.unpin-btn');
            dragable_part = $('#mydivheader');
            player_container = $('.vr-player-container');
            resizible = $('#resizable');
            full_s_btn = $('.full-screen-btn');


            unpin_btn.on('click', function () {
                unpinPlayer();
            });

            full_s_btn.on('click', function () {
                fullScreen();
            });

            timeline = $('#timeline');


            $('.ui-resizable-handle').css('display', 'none');

            timelineFunc();

            $( "#resizable" ).resizable({
                handles: "e, s, w, n,se, sw, nw, ne",
                minHeight: 150,
                minWidth: 200,
                aspectRatio: 16 / 9

            });
            $("#resizable").find("div.ui-resizable-se").removeClass("ui-icon");
            $("#resizable").find("div.ui-resizable-se").removeClass("ui-icon-gripsmall-diagonal-se");


            $('.play-btn').on('click', function () {
                PlayPauseVideo();
            });

            $( "#vol-control, .volume-btn" ).hover(
                function() {
                    $( '#vol-control' ).fadeIn(50);

                }, function() {
                    $( '#vol-control' ).fadeOut(50);
                }
            );

            $('.volume-btn').on('click', function () {
               if (document.getElementById("video").volume !== 0) {
                   last_volume = document.getElementById("video").volume * 100;
                   SetVolume(0);
                   $('#vol-control').val(0);
               } else {
                   SetVolume(last_volume);
                   $('#vol-control').val(last_volume);

               }
            });

            $('.sub-btn').on('click', function () {
               displayHideTitles();
            });


            function hideToolbar() {
                $('.bottom-bar, .top-left-bar, .top-right-bar, .volume-btn, .play-btn, .bottom-panel-border-rb, .bottom-panel-border-lb, .bottom-panel-border-rt, .bottom-panel-border-lt').fadeOut(400);
                $('#mydivheader').css('cursor',  'none');
            }

            var hidePanels = window.setInterval(hideToolbar, 4000);

            $( "#mydivheader, .bottom-bar-outer, #timeline, .bottom-bar, .top-left-bar, .top-right-bar, .volume-btn, .play-btn, .bottom-panel-border-rb, .bottom-panel-border-lb, .bottom-panel-border-rt, .bottom-panel-border-lt" ).mousemove(function( event ) {
                $('.bottom-bar, .top-left-bar, .top-right-bar, .volume-btn, .play-btn, .bottom-panel-border-rb, .bottom-panel-border-lb, .bottom-panel-border-rt, .bottom-panel-border-lt').fadeIn(400);
                $('#mydivheader').css('cursor',  'default');
                clearInterval(hidePanels);
                hidePanels = window.setInterval(hideToolbar, 4000);
            });

            loadVideo(full_movie_name);


            // ***************************************************

        });
    };

    function getCurrentMovieSize() {
        // console.log('***  3| getCurrentMovieSize [in]***');

        // console.log('3| getting current size of torrent');

        //todo ostanovka
        $.post( php_script_size_path, { movie_path: movie_folder, _token: $('meta[name=csrf-token]').attr('content')})
            .done(function( data ) {


                video_downloaded = data;

                console.log('3| torrent_downloaded = [' + video_downloaded + ']');

                // console.log('3| check how many % dowloaded');
                if (video_downloaded > 2 && player_created_flag === 0) {
                    console.log('3| more than 5% dowloaded');
                    player_created_flag = 1;


                    // console.log('3| call player constructor');
                    initPlayer(movie_name, movie_titles, p_container);
                } else {
                    if (video_downloaded < 2) {
                        $('.loading-info').html(Math.round((video_downloaded)  * 50) + '%');
                    }
                }


                // if (title_flag === 0 && typeof(movie_titles) !== "undefined" && video_downloaded > 5 ) {
                //      parseSubtitle(movie_titles);
                //
                //      alert('try to find 1');
                //
                //
                //      console.log('type 1 = ' + typeof(subtitleEn));
                //     if ( typeof(subtitleEn) !== "undefined") {
                //         $('.sub-btn').css('display', 'block');
                //         alert('dd2');
                //         title_flag = 1;
                //     }
                // }

                // if (progress_flag === 0 ) {
                //     source_progress = video_downloaded;
                //     progress_flag = 1;
                // }



                if (video_downloaded >= 100) {
                    $('#redline').css('width', '0%');
                    clearInterval(SizeRequest);

                    // if (title_flag === 0 && typeof(movie_titles) !== "undefined" && video_downloaded > 5 ) {
                    //     parseSubtitle(movie_titles);
                    //
                    //     if ( typeof(subtitleEn) !== "undefined") {
                    //         $('.sub-btn').css('display', 'block');
                    //         title_flag = 1;
                    //     }
                    // }

                    source_progress = 100;
                } else {
                    $('#redline').css('width', (100 - (video_downloaded ) + 20 ) + '%');
                }
            });

        // console.log('***  3| getCurrentMovieSize [out]***');
    }



    var startLoading = function (folder_name, container) {
        console.log('***** 2| startLoading [in] *****');

        console.log('2| start interval to getting current movie size');
        SizeRequest = window.setInterval(getCurrentMovieSize, 1000);

        console.log('***** 2| startLoading [out] *****');
    };

    var dataFromFolder = function (folder_name, container) {
        console.log('***** 1| dataFromFolder [in] *****');
        container.html('<div class="preload-page"><div class="loading-info">0%</div><div class="player-42-logo"></div><div class="player-unit-logo"></div><div class="pre-text"><div class="player-pre-text"><span class="notranslate">Hypertube</span> player.</div> <br/>Подготовка файлов. <br/> Пожалуйста, подождите.</div></div>');

        movie_folder = folder_name; console.log('1| movie_folder = ' + movie_folder);
        movie_folder = movie_folder.replace('public/','');

        p_container = container;  console.log('1| player_container = ' + p_container);


        console.log('1| getting movie info');
        $.post( php_script_patch, { folder: folder_name, _token: $('meta[name=csrf-token]').attr('content')})
            .done(function( data ) {
                console.log("data [", data, "]");
                var movie_info = jQuery.parseJSON( data );
                console.log('1| get info about movie from folder');

                movie_name = movie_info[0];  console.log('1| movie_name = ' + movie_name);
                movie_titles = movie_info[1]; console.log('1| movie_titles = ' + movie_titles);

                console.log('1| start checking loading');
                startLoading(movie_folder, p_container);








                // if (video_downloaded > 0) {
                //     player_created_flag = 1;
                //     initPlayer(movie_name, movie_titles, p_container);
                //
                //     return;
                // }

                // initPlayer(movie_info[0], movie_info[1], container);
            });
        console.log('***** 1| dataFromFolder [out] *****');

    };




    // -----------------------------------------





    $(document).keydown(function(e) {
        if (e.which == 32) {
            HyperPlayer.playPause();
            return false;
        }
    });

    $('body').on('click', function (e) {
        if (e.target.id === "mydivheader")
        {
            HyperPlayer.playPause();
        }
    });


    var displayTitles = function () {
        $('.sub-btn').css('opacity', '1');
        $('.title-outer').css('display', 'flex');
        titles_display = 1;
    };

    var hideTitles = function () {
        $('.sub-btn').css('opacity', '0.5');
        $('.title-outer').css('display', 'none');
        titles_display = 0;
    };


    var displayHideTitles = function () {
        if (titles_display === 0) {
            displayTitles();
        } else {
            hideTitles();
        }
    };

    var playVideo = function () {
        console.log('[play action]');
        if (line_percent >= video_downloaded) {
            console.log('[cancel play action] => line_percent(' + line_percent +') >= ' + '( + ' + video_downloaded + ')' );
            return;
        }

        $('.play-btn').addClass('pause-bgr');
        document.getElementById("video").play();
    };

    var pauseVideo = function () {
        console.log('[pause action]');
        $('.play-btn').removeClass('pause-bgr');
        document.getElementById("video").pause();
    };


    function PlayPauseVideo() {
        if (flag_click !== 0) {
            if (document.getElementById("video").paused) {
                playVideo();
            }
            else {
                pauseVideo();
            }
        }
        flag_click = 1;
    }




    var smallScreen = function () {

        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    };

    $(document).on('webkitfullscreenchange mozfullscreenchange fullscreenchange', function(e) {

        if (full_s_btn.hasClass('small-screen-btn')) {
            full_s_btn.removeClass('small-screen-btn');
        } else {
            full_s_btn.addClass('small-screen-btn');

        }

        $('.bottom-bar').fadeIn(0);
        $('.top-left-bar').fadeIn(0);
        $('.top-right-bar').fadeIn(0);
        $('#mydivheader').css('cursor',  'default');
        unping_btn.toggle();
        save_btn.toggle();
    });

    var fullScreen = function() {
        pinPlayer();

        if (full_s_btn.hasClass('small-screen-btn')) {
            smallScreen();
            return ;
        }

        $('#mydiv').css("width", "100%");
        $('#mydiv').css("height", "100%");
        $('#resizable').css("width", "100%");
        $('#resizable').css("height", "100%");


        var mydiv = document.querySelector("#mydiv");

        if (mydiv.requestFullscreen) {
            mydiv.requestFullscreen();
        } else if (mydiv.mozRequestFullScreen) {
            mydiv.mozRequestFullScreen(); // Firefox
        } else if (mydiv.webkitRequestFullscreen) {
            mydiv.webkitRequestFullscreen(); // Chrome and Safari
        }
    };

    var pinPlayer = function () {
        unpin_btn.removeClass('unpinned-btn');
        $('.ui-resizable-handle').css('display', 'none');
        dragable_part.css('cursor', 'auto');
        resizible.css('width', '100%').css('height', '100%');
        resizible.css('left', 0).css('top', 0);
        player_container.css('width',  '100%').css('height',  '100%');
        player_container.css('top', 0 + 'px').css('left', 0 + 'px');
        player_container.css('position', 'inherit');
    };

    var unpinPlayer = function () {
        if (unpin_btn.hasClass('unpinned-btn')) {
            pinPlayer();
            return ;
        }
        unpin_btn.addClass('unpinned-btn');
        $('.ui-resizable-handle').css('display', 'block');
        dragable_part.css('cursor', 'move');
        player_container.css('top', 20 + 'px').css('left', 20 + 'px');
        player_container.css('width', player_container.parent().width() + 'px').css('height',  player_container.parent().height()+'px');


        player_container.css('position', 'absolute');
    };

    return {
        initPlayer: initPlayer,
        dataFromFolder: dataFromFolder,
        play: playVideo,
        pause: pauseVideo,
        playPause: PlayPauseVideo
    };

})();