<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 'users';

    protected $fillable = [
        'username','name', 'email', 'password','status','verif_token','token','type'
    ];

    protected $hidden = [
        'password'
    ];


}
