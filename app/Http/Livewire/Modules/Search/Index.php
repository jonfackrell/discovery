<?php

namespace App\Http\Livewire\Modules\Search;

use App\Modules\Search\Indexes\Manager;
use Livewire\Component;

class Index extends Component
{

    public $term = '';
    public $items;

    protected $updatesQueryString = ['term'];

    public function mount()
    {
        $this->term = request('term');
    }

    public function render()
    {
        // get all managers
        // Loop through managers to get search results
        // combine search results
        $indexes = collect([]);
        $this->items = [];
        foreach(['EDS'] as $index){
            $indexes = $indexes->merge(Manager::get($index)->search($this->term));
        }
        // TODO: process other elements such as facets
        foreach ($indexes->sortByDesc('relevancy') as $key => $item){
            $this->items[] = $item;
        }

        return view('livewire.modules.search.index');
    }
}
