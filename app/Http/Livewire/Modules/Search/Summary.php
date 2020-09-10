<?php

namespace App\Http\Livewire\Modules\Search;

use App\Modules\Search\Models\EDS\Item;

use App\Modules\Search\Traits\Likeable;
use App\Modules\Search\Traits\Saveable;
use Livewire\Component;

class Summary extends Component
{

    use Likeable, Saveable;

    public $item;

    protected $listeners = [
        'toggleLike',
    ];

    public function mount(Item $item)
    {
        $this->item = $item->toArray();
    }

    public function render()
    {
        //dd($this->item);

        return view('Search::partials.summary');
    }

}
