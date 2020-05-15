<?php

namespace App\Modules\Stackmaps\Models;

use Illuminate\Database\Eloquent\Model;

class FullSortkey extends Model
{
    public function fshelf()
    {
        return $this->hasOne(FullShelf::class,'user_id');
    }
}
