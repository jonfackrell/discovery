<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SharedFolder extends Model
{
    protected $table = 'shared_folder';

    protected $fillable = [
        'user_id',
        'folder_id',
    ];
}
