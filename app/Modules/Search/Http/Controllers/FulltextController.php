<?php

namespace App\Modules\Search\Http\Controllers;

use App\Modules\Search\Indexes\Manager;
use Illuminate\Http\Request;

class FulltextController extends Controller
{
    /**
     * Show search results.
     *
     * @return View
     */
    public function __invoke(Request $request, $item)
    {
        list($this->index, $this->itemId) = explode(':', request('item'));
        $record = Manager::get($this->index)->retrieve($this->itemId);
        $item = (new \App\Modules\Search\Models\EDS\Item())->setRecord($record);
        //dd($item->full_text_link);
        return view('livewire.modules.search.pdf', [
            'item' => $item,
            'url' => $item->pdf_link,
        ]);
    }
}
