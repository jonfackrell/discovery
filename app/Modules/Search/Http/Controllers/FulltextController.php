<?php

namespace App\Modules\Search\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Modules\Search\Models\EDS\Item;
use Illuminate\Http\Request;
use JonFackrell\Eds\Facades\EbscoDiscovery;

class FulltextController extends Controller
{
    /**
     * Show search results.
     *
     * @return View
     */
    public function __invoke(Request $request, $database, $an)
    {
        //$index = new EDS();
        $record = EbscoDiscovery::retrieve("$database|$an");
        $item = (new Item())->setRecord($record);

        return view('Search::embed', [
            'item' => $item,
            'url' => $item->pdf_link,
        ]);
    }
}
