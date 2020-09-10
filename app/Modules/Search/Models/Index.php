<?php

namespace App\Modules\Search\Models;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'info' => 'array',
    ];
}
