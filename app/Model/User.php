<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 'users';

    protected $fillable = [
        'password','name','verif_token','token'
    ];

    protected $hidden = [
        'password','token'
    ];


}
