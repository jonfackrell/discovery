<?php

namespace App\Modules\Stackmaps\Http\Controllers;

use App\Modules\Stackmaps\Models\FullShelf;
use App\Modules\Stackmaps\Models\Map;
use App\Modules\Stackmaps\Models\Sort;
use Illuminate\Http\Request;

class MapSearchController extends Controller
{
    /**
     * Show search results.
     *
     * @return View
     */
    public function __invoke(Request $request)
    {

        //$masks = (new Map)->insertFullKey('PR5360', 'PS549');


        /*$callno = 'PR5360.O93 H37 2017';
        //$callno = 'PR5360.092'; // Start
        //$callno = 'PS549'; // End

        $masks = FullShelf::makeMask($callno);

        $amask = $masks[0];
        $smask = $masks[1];
        $calla = $masks[2];

        //$pre_sort_key = FullShelf::pMask($amask,$smask,$callno,$calla);
        $pre_sort_key = Sort::pMask($amask,$smask,$callno,$calla);

        $callno = 'PR5360.O93 H37 2017'; // End

        $masks = FullShelf::makeMask($callno);

        $amask = $masks[0];
        $smask = $masks[1];
        $calla = $masks[2];

        //$pre_sort_key = FullShelf::pMask($amask,$smask,$callno,$calla);
        $pre_sort_key_start = Sort::pMask($amask,$smask,$callno,$calla);

        dd($pre_sort_key_start, $pre_sort_key, $pre_sort_key_start <= $pre_sort_key);*/

        //$masks = (new Map)->insertFullKey($amask,$smask,$callno,$calla,'end');

        //return "Added $callno";

        //dd(Map::with('keys')->where('id', 1)->get());
        dd((new Map)->locate('PR6068.O93 H37 2017'));

    }
}
