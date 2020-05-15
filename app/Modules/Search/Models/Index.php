<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Index extends Model
{


    protected $fillable = [
        'name',
        'auth_token',
        'auth_token_expires_at',
    ];

    protected $dates = [
        'auth_token_expires_at',
    ];
}
