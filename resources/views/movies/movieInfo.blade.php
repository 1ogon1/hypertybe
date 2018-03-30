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
        <div class="panel panel-default">
            <div class="panel-heading">
                <header class="panel-title">
                    <div class="text-center">
                        <strong>Детально</strong>
                    </div>
                </header>
            </div>
            <div class="panel-body">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="detail">
                        <div class="row">
                            <div class="col-sm-2 col-xs-2">
                                <b>Жанр:</b>
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
                                <b>Описание:</b>
                            </div>
                            <div class="col-sm-10 col-xs-10">
                                <p>{{ $movieInfo['description_full'] }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 col-xs-2">
                                <b>Год:</b>
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
                                        Скачать:
                                    </b>
                                </p>
                            </div>
                            @foreach ($movieInfo['torrents'] as $torrent)
                                <div class="col-sm-2 col-xs-2 bottom">
                                    <a href="{{ $torrent['url'] }}">
                                        {{ $torrent['quality'] }}
                                    </a>
                                </div>
                                <div class="col-sm-10 col-xs-10 bottom">
                                    Объем: {{ $torrent['size'] }}
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
    <div class="col-sm-offset-1 col-sm-10">
        <div class="comment-list" id="comments">
            @foreach($comments as $comment)
                <div class="comment-block">
                    <div class="comment-name">
                        <a href="/profile/{{$comment->user_id}}">
                            {{$comment->name}} {{ $comment->surname }}
                        </a>
                        <span>
                                {{ $comment->created_at }}
                            </span>
                    </div>
                    <div class="comment-text">
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
                        <label for="comment">Оставить коментарий</label>
                        <textarea class="form-control" rows="5" draggable="false" id="comment"
                                  name="comment"></textarea>
                    </div>
                    <button type="submit" id="comment_btn" class="btn btn-primary">Отправить</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.footer')
<script src="{{URL::asset('js/movieinfo.js')}}" type="text/javascript"></script>