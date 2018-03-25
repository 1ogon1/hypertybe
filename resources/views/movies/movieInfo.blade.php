@include('layout.header')
    {{--<link rel="stylesheet" href="http://bootstraptema.ru/plugins/2015/bootstrap3/bootstrap.min.css"/>--}}
    {{--<script src="http://bootstraptema.ru/plugins/jquery/jquery-1.11.3.min.js"></script>--}}
    {{--<script src="http://bootstraptema.ru/plugins/2015/b-v3-3-6/bootstrap.min.js"></script>--}}

    {{--<style type="text/css">--}}


    {{--</style>--}}

    <div class="container">
        <div id="main">


            <div class="row" id="real-estates-detail">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <header class="panel-title">
                                <div class="text-center">
                                    <strong>Movie</strong>
                                </div>
                            </header>
                        </div>
                        <div class="panel-body">
                            <div class="text-center" id="author">
                                <img id="profilePhoto"
                                     src="{{ $movieInfo['large_cover_image'] }}">

                                <h3>{{ $movieInfo['title_english'] }}</h3>
                                <p>{{ $movieInfo['year'] }}</p>
                                <p>IMDb:
                                    <small class="label label-warning"><?php echo $movieInfo['rating'] ?></small>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-xs-12">
                    <div class="panel">
                        <div class="panel-body">

                            <div id="myTabContent" class="tab-content">
                                <hr>
                                <div class="tab-pane fade active in" id="detail">
                                    <!-- <h4>Movie information</h4> -->
                                    <table class="table">
                                        <tr>
                                        <th>Genres</th>
                                            @foreach ($movieInfo['genres'] as $genre)

                                            <td>{{ $genre }}</td>

                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>Synopsis</th>
                                            <td>{{ $movieInfo['description_full'] }}</td>
                                        </tr>
                                    </table>
                                    <h4>Torrents</h4>
                                        <table class="table">
                                        @foreach ($movieInfo['torrents'] as $torrent)

                                        <tr>
                                            <th><a href="{{ $torrent['url'] }}">{{ $torrent['quality'] }}</a></th>
                                            <td>Size: {{ $torrent['size'] }}</td>
                                        </tr>

                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>

@include('layout.footer')