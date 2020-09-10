<?php

namespace App\Modules\Search\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Search\Indexes\EDS;
use App\Modules\Search\Models\EDS\Item;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Show search results.
     *
     * @return View
     */
    public function __invoke(Request $request, $database, $an)
    {
        $index = new EDS();
        $record = $index->retrieve("$database|$an");
        $item = (new Item())->setRecord($record);

        return redirect()->to($item->full_text_link['url']);
    }
}
