<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{

    public function __construct()
    {
        session_start();
    }

    public function index()
    {
        if (!isset($_SESSION['email']) && $_SESSION['user_id'] != 0) {
            return redirect('/login/')->with('warning', 'Please login first!');
        }
        $user = DB::table('users')->where('id', $_SESSION['user_id'])->first();

        $client = new Client(); //GuzzleHttp\Client
        $json = $client->get('https://yts.am/api/v2/list_movies.json?sort_by=rating&limit=12')->getBody();

        $data = \GuzzleHttp\json_decode($json, true);
        $movie_count = $data['data']['movie_count'];

        $page_count = $movie_count / 12;
        $sort_by = 'like_count';

        $genres = array('All', 'Action', 'Adventure',
            'Animation',
            'Biography',
            'Comedy',
            'Crime',
            'Documentary',
            'Drama',
            'Family',
            'Fantasy',
            'History',
            'Horror',
            'Music',
            'Musical',
            'Mystery',
            'Romance',
            'Sport',
            'Thriller',
            'War',
            'Western');

        $qualitys = array('All', '720p', '1080p', '3D');

        return view('movies.movies')->with([
            'data' => $data,
            'sort_by' => $sort_by,
            'page_count' => $page_count,
            'genres' => $genres,
            'qualitys' => $qualitys,
            'user' => $user,
            'title' => 'Films'
        ]);
    }

    public function getMovies(Request $request)
    {

        $page = $request->input('page');
        $sort_by = $request->input('sort');
        $order_by = $request->input('order_by');
        $quality = $request->input('quality');
        $minimum_rating = $request->input('minimum_rating');
        $query_term = $request->input('query_term');
        $genre = $request->input('genre');

        $query = '';
        if ($page != '')
            $query = $query . '&page=' . $page;
        if ($quality != '')
            $query = $query . '&quality=' . $quality;
        if ($minimum_rating != '')
            $query = $query . '&minimum_rating=' . $minimum_rating;
        if ($query_term != '')
            $query = $query . '&query_term=' . $query_term;
        if ($genre != '' && $genre != 'All')
            $query = $query . '&genre=' . $genre;
        if ($sort_by != '')
            $query = $query . '&sort_by=' . $sort_by;
        else
            $query = $query . '&sort_by=title';
        if ($order_by != '')
            $query = $query . '&order_by=' . $order_by;

        $client = new Client(); //GuzzleHttp\Client
        $json = $client->get('https://yts.am/api/v2/list_movies.json?limit=12' . $query)->getBody();

        $data = \GuzzleHttp\json_decode($json, true);
        return $data;
    }
}