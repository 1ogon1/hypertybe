<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'comments';
    protected $fillable = [
        'user_id',
        'comment'

    ];
}
