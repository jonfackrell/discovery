<?php

namespace App\Modules\Search\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];
}
