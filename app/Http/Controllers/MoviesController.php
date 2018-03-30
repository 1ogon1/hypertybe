<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Movie2Comment;
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
        if (!isset($_SESSION['email']) && !isset($_SESSION['user_id'])) {// && $_SESSION['user_id'] != 0) {
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

    public function movieInfo($id)
    {
        if (!isset($_SESSION['email']) && !isset($_SESSION['user_id'])) {// && $_SESSION['user_id'] != 0) {
            return redirect('/login/')->with('warning', 'Please login first!');
        }

        $client = new Client(); //GuzzleHttp\Client
        $json = $client->get('https://yts.am/api/v2/movie_details.json?movie_id=' . $id . '&with_images=true&with_cast=true')->getBody();

        $data = \GuzzleHttp\json_decode($json, true);

        $movieInfo = $data['data']['movie'];

        $comment = DB::table('movie2comments')
                        ->leftJoin('comments', 'movie2comments.comment_id', '=', 'comments.id')
                        ->leftJoin('users', 'comments.user_id', '=', 'users.id')
                        ->select('comments.*', 'users.name', 'users.surname', 'users.id')
                        ->where('movie2comments.movie_id', $id)
                        ->orderBy('comments.created_at', 'desc')
                        ->get();

        return view('movies.movieInfo')->with([
            'movieInfo' => $movieInfo,
            'title' => $movieInfo['title_english'],
            'comments' => $comment
        ]);
    }

    public function AddComment()
    {
        if (!empty($_POST['comment']))
        {
            $comment = new Comment();

            $comment['user_id'] = $_SESSION['user_id'];
            $comment['comment'] = $_POST['comment'];

            if ($comment->save())
            {
                $movie2comment = new Movie2Comment();

                $movie2comment['comment_id'] = $comment->id;
                $movie2comment['movie_id'] = $_POST['movie_id'];

                $movie2comment->save();

                $user = DB::table('users')->where('id', $_SESSION['user_id'])->first();

                $result = [
                    'type' => 'success',
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'comment' => htmlspecialchars($comment->comment),
                    'created_at' => $comment->created_at,
                    'user_surname' => $user->surname
                ];

                return json_encode($result);
            }
            $result = [
                'type' => 'error',
                'message' => 'Не удалось сохранить комментарий'
            ];
            return json_encode($result);
        }
        $result = [
            'type' => 'error',
            'message' => 'Коментарий пустой'
        ];
        return json_encode($result);
    }
}