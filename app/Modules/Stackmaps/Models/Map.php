<?php

namespace App\Modules\Stackmaps\Models;

use App\FullSortkey;
use App\Sort;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    public function locate($collection, $callno)
    {
        if (in_array($collection, ['Maps - 1st Floor East Wing', 'Service Desk - DVDs', 'Service Desk - CDs'])) {
            $map = Map::where('collection', $collection)
                ->first();
            return $map;
        }
        $masks = FullShelf::makeMask($callno);

        $amask = $masks[0];
        $smask = $masks[1];
        $calla = $masks[2];

        $pre_sort_key = \App\Modules\Stackmaps\Models\Sort::pMask($amask, $smask, $callno, $calla);
        //dd($pre_sort_key);
        $map = Map::where('collection', $collection)
                    ->where('start', '<=', $pre_sort_key)
                    ->where('end', '>=', $pre_sort_key)
                    ->first();

        return $map;
    }

    public static function generateSortKey($callno)
    {
        $masks = FullShelf::makeMask($callno);

        $amask = $masks[0];
        $smask = $masks[1];
        $calla = $masks[2];

        return \App\Modules\Stackmaps\Models\Sort::pMask($amask, $smask, $callno, $calla);
    }
}
