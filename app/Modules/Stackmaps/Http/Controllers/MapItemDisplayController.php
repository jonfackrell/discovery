<?php

namespace App\Modules\Stackmaps\Http\Controllers;

use App\Modules\Stackmaps\Models\FullShelf;
use App\Modules\Stackmaps\Models\Map;
use App\Modules\Stackmaps\Models\Sort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapItemDisplayController extends Controller
{
    /**
     * Show search results.
     *
     * @return View
     */
    public function __invoke(Request $request, $collection, $call)
    {
        $response = Http::get(
            'https://abish.byui.edu/horizon/api/index.cfm/summary/',
            [
                'authorization' => env('HORIZON_API_TOKEN'),
            ]
        );

        if ($response->ok()) {
            $map = (new Map)->locate($response->json()['collection'], $response->json()['call_number']);
        } else {
            $map = null;
        }




        return view('Stackmaps::item', [
            'map' => $map,
        ]);
    }
}
