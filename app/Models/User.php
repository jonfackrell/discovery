<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\SchemalessAttributes\SchemalessAttributes;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'options' => 'array',
    ];

    public function getFirstNameAttribute()
    {
        return explode(' ', $this->name)[0];
    }

    public function getLastNameAttribute()
    {
        return last(explode(' ', $this->name));
    }

    /**
     * The folders that belong to the user.
     */
    public function folders()
    {
        return $this->hasMany(Folder::class)->whereNull('folder_id')->with('subFolders')->orderBy('name', 'ASC');
    }

    public function subFolders()
    {
        return $this->hasMany(Folder::class)->with('folders');
    }

    /**
     * The likes that belong to the user.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function shares()
    {
        return $this->belongsToMany(Folder::class, 'shared_folder');
    }

    public function getOptionsAttribute(): SchemalessAttributes
    {
        return SchemalessAttributes::createForModel($this, 'options');
    }

    public function scopeWithOptions(): Builder
    {
        return SchemalessAttributes::scopeWithSchemalessAttributes('options');
    }
}
