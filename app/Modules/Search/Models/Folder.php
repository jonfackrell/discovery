<?php

namespace App;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use GeneratesUuid;

    protected $fillable = [
        'user_id',
        'name',
    ];

    public function uuidColumns(): array
    {
        return ['uuid'];
    }

    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];

    public function folders()
    {
        return $this->hasMany(Folder::class);
    }

    public function subFolders()
    {
        return $this->hasMany(Folder::class)->with('folders');
    }

    public function getShareableLinkAttribute()
    {
        return route('folder.link.public', ['uuid' => $this->uuid]);
    }

    public function shares()
    {
        return $this->belongsToMany(User::class, 'shared_folder');
    }
}
