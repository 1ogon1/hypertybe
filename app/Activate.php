<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Activate extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'activates';
    protected $fillable = [
        'token',
        'user_email'
    ];
}
