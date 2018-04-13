@include('layout.header')

<div class="row" id="real-estates-detail">
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <header class="panel-title">
                    <div class="text-center">
                        <strong>{{ $movieInfo['title_english'] }}</strong>
                    </div>
                </header>
            </div>
            <div class="panel-body">
                <div class="text-center" id="author">
                    <img id="profilePhoto" src="{{ $movieInfo['large_cover_image'] }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <header class="panel-title">
                            <div class="text-center">
                                <strong>Details</strong>
                            </div>
                        </header>
                    </div>
                    <div class="panel-body">
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in" id="detail">
                                <div class="row">
                                    <div class="col-sm-2 col-xs-2">
                                        <b>Genre:</b>
                                    </div>
                                    <div class="col-sm-10 col-xs-10">
                                        <p>
                                            @foreach($movieInfo['genres'] as $genre)
                                                <span>
                                            {{$genre}}
                                        </span>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-xs-2">
                                        <b>Description:</b>
                                    </div>
                                    <div class="col-sm-10 col-xs-10">
                                        <p>{{ $movieInfo['description_full'] }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-xs-2">
                                        <b>Year:</b>
                                    </div>
                                    <div class="col-sm-10 col-xs-10">
                                        <p>{{ $movieInfo['year'] }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-xs-2">
                                        <b>IMDb:
                                        </b>
                                    </div>
                                    <div class="col-sm-10 col-xs-10">
                                        <p>
                                            <small class="label label-warning"><?php echo $movieInfo['rating'] ?></small>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p>
                                            <b>
                                                Download:
                                            </b>
                                        </p>
                                    </div>
                                    @foreach ($movieInfo['torrents'] as $torrent)
                                        <div class="col-sm-2 col-xs-2 bottom movie-info" data-title="{{$movieInfo['title_english']}}" data-torrent="{{ base64_encode($torrent['url']) }}" data-quality="{{ $torrent['quality'] }}">
                                            {{ $torrent['quality'] }}
                                        </div>
                                        <div class="col-sm-10 col-xs-10 bottom">
                                            Size: {{ $torrent['size'] }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <header class="panel-title">
                            <div class="text-center">
                                <strong>Video player</strong>
                            </div>
                        </header>
                    </div>
                    <div class="panel-body video-panel">
                        <div class="loader movie-info-loader"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="comment-list" id="comments">
            @foreach($comments as $comment)
                <div class="comment-block">
                    <div class="comment-name notranslate">
                        <a href="/profile/{{$comment->user_id}}" class="notranslate">
                            {{$comment->name}} {{ $comment->surname }}
                        </a>
                        <span>
                                {{ $comment->created_at }}
                            </span>
                    </div>
                    <div class="comment-text notranslate">
                        {{$comment->comment}}
                    </div>
                </div>
            @endforeach
        </div>
        <div class="panel panel-form">
            <div class="panel-body">
                <div {{--action="{{ route('addcomment') }}" method="post"--}}>
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="movie_id" name="movie_id" value="{{ $movieInfo['id']  }}">
                    <div class="form-group">
                        <label for="comment">Leave a comment</label>
                        <textarea class="form-control" rows="5" draggable="false" id="comment"
                                  name="comment" style="resize: none;"></textarea>
                    </div>
                    <button type="submit" id="comment_btn" class="btn btn-primary">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.footer_info')
<script src="{{URL::asset('js/movieinfo.js')}}" type="text/javascript"></script>