<?php

namespace App\Modules\Search\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Show search results.
     *
     * @return View
     */
    public function __invoke(Request $request, $item)
    {
        return view('Search::show', [

        ]);
    }
}
