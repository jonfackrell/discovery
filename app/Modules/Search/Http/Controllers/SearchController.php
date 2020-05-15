<?php

namespace App\Modules\Search\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Show search results.
     *
     * @return View
     */
    public function __invoke(Request $request)
    {
        return view('Search::index', [

        ]);
    }
}
