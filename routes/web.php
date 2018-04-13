<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* GET */
Route::get('/', 'MoviesController@index');

Route::get('/login', 'IndexController@Login');
Route::get('/register', 'IndexController@Register');

Route::get('/activate/{token}', 'IndexController@Activate');

Route::get('/reset/{token?}', 'IndexController@ResetPassword');

Route::get('/profile/{id}', 'IndexController@profile');

Route::get('intralogin', 'IndexController@intralogin');
Route::get('facebooklogin', 'IndexController@facebooklogin');

Route::get('logout', 'IndexController@logout')->name('logout');
/* MOVIE */
//Route::get('movies', 'MoviesController@index');
Route::get('api/get_movies', 'MoviesController@getMovies');
Route::get('parse_movies', 'MoviesController@parseMovies');
Route::get('movies/{id}', 'MoviesController@movieInfo');



//Route::get('downloadmovie/{name}/{link}/{quality}', 'MoviesController@DownloadMovie');

Route::post('downloadmovie', 'MoviesController@DownloadMovie')->name('downloadmovie');
/* POST */
Route::post('signin', 'IndexController@SignIn')->name('signin');
Route::post('signup', 'IndexController@SignUp')->name('signup');
Route::post('update', 'IndexController@Update')->name('update');
Route::post('addcomment', 'MoviesController@AddComment')->name('addcomment');
Route::post('resetpw', 'IndexController@ResetPasswordSend')->name('resetpw');

Route::post('filesize', 'MoviesController@FileSize')->name('filesize');
Route::post('findmovie', 'MoviesController@FindMovie')->name('findmovie');
//Route::get('/findmovie/{folder}', 'MoviesController@FindMovie');//->name('findmovie');