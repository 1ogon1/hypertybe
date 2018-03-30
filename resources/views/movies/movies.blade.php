@include('layout.header')
<div class="row filter">
    <div class="col-lg-4">
        <p>Genre:</p>
        <select name="" id="genre">
            @foreach ($genres as $genre)
                <option value="{{ $genre }}">{{ $genre }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-4">
        <p>Minimal rating:</p>
        <select name="" id="minimalRating">
            @for($i = 0; $i < 10; $i++)
                <option value="{{ $i }}">{{ $i }}+</option>
            @endfor
        </select>
    </div>
    <div class="col-lg-4">
        <p>Quality:</p>
        <select class="custom-select" name="" id="quality">
            @foreach ($qualitys as $quality)
                <option value="{{ $quality }}">{{ $quality }}</option>
            @endforeach
        </select>
    </div>
    <button id="filterButton" type="button" class="btn btn-primary">Search</button>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="input-group">
                <input id="input" type="text" class="form-control" placeholder="Search film">
                <div id="search" class="input-group-addon"><a href="">Search</a></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="filter">
            <p>Sort</p>
            <a class="sortButton" href="" data-sort="title">Title</a>
            <a class="sortButton" href="" data-sort="year">Year</a>
            <a class="sortButton" href="" data-sort="rating">Rating</a>
        </div>
    </div>
</div>

<div id="pattern" class="row pattern" data-page="{{ $data['data']['page_number'] }}" data-sort="{{ $sort_by }}"
     data-page_count="{{ $page_count }}" data-order_by="desc" data-quality="All" data-minimum_rating="0"
     data-genre="All" data-query_term="0">
    <div class="col-lg-12">
        <ul class="list img-list">
            @foreach ($data['data']['movies'] as $movie)
                <li>
                    <div class="li-img">
                        <a href="movies/{{ $movie['id'] }}">
                            <img src="{{ $movie['medium_cover_image'] }}"/>
                        </a>
                    </div>
                    <div class="li-text">
                        <a href="movies/{{ $movie['id'] }}">
                            <h4 class="li-head">{{ $movie['title'] }}</h4>
                        </a>
                        <p class="li-sub">{{ $movie['year'] }}</p>
                        <p class="li-sub">IMDb: {{ $movie['rating'] }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12" style="height: 64px;">
        <div class="loader"></div>
    </div>
</div>
<a href="#top" class="to-top"></a>

@include('layout.footer')
<script src="{{URL::asset('js/movie.js')}}" type="text/javascript"></script>