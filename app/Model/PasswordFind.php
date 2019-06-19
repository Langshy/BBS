<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PasswordFind extends Model
{
    //
    public $timestamps = false;
    
    protected $table = 'password_forget';

    protected $fillable = [
        'email','token','create_time'
    ];
}
