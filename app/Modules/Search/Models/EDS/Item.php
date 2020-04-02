<?php

namespace App\Modules\Search\Models\EDS;
use Illuminate\Database\Eloquent\Model;

class Item extends \App\Item
{

    protected $record;

    public function __construct($record, array $attributes = [])
    {
        parent::__construct($attributes);
        $this->record = $record;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'index', 'relevancy', 'name', 'author',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    public function getIndexAttribute()
    {
        return 'EDS';
    }

    public function getTitleAttribute()
    {
        $name = '';
        try{
            $name = collect($this->record['Items'])->where('Name', 'Title')->first()['Data'];
        }catch(\Exception $e){

        }
        return $name;
    }

    public function getAuthorAttribute()
    {
        $author = '';
        try{
            $author = collect($this->record['Items'])->where('Name', 'Author')->first()['Data'];
        }catch(\Exception $e){

        }
        return $author;
    }

}
