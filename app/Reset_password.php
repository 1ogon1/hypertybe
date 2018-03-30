<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Reset_password extends Model
{
    use Notifiable;


    protected $primaryKey = 'id';
    protected $table = 'reset_passwords';
    protected $fillable = [
        'user_email',
        'token',
        'newpw'
    ];
}
