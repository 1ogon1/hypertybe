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
Route::get('/', 'IndexController@Index');

Route::get('/login', 'IndexController@Login')->name('login');
Route::get('/register', 'IndexController@Register')->name('register');

Route::get('/profile/{id}', 'IndexController@profile')->name('profile');

Route::get('intralogin', 'IndexController@intralogin')->name('intralogin');
Route::get('facebooklogin', 'IndexController@facebooklogin')->name('facebooklogin');

Route::get('logout', 'IndexController@logout')->name('logout');
/* POST */
Route::post('signin', 'IndexController@SignIn')->name('signin');
Route::post('signup', 'IndexController@SignUp')->name('signup');
Route::post('update', 'IndexController@Update')->name('update');
