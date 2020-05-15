<?php

namespace App\Modules\Search\Http\Controllers;

use App\Modules\Search\Indexes\Manager;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    /**
     * Show search results.
     *
     * @return View
     */
    public function __invoke(Request $request)
    {
        $records = explode('|', $request->records);
        $items = [];
        foreach ($records as $record) {
            list($index, $database, $an) = explode(':', $record);
            $items[] = Manager::get($index)->export($database, $an);
        }
        return view('Search::export', [
            'items' => $items,
        ]);
    }
}
