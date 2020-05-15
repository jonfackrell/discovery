<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FolderItem extends Model
{
    protected $table = 'folder_item';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];
}
