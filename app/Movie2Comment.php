<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Movie2Comment extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'movie2comments';
    protected $fillable = [
        'comment_id',
        'movie_id',

    ];
}
