<?php

namespace App\Http\Livewire\Modules\Search;

use App\Modules\Search\Indexes\Manager;
use Livewire\Component;

class Item extends Component
{

    public $index;
    public $itemId;
    public $item;

    public function mount()
    {
        list($this->index, $this->itemId) = explode(':', request('item'));
        $this->item = Manager::get($this->index)->retrieve($this->itemId);
    }

    public function render()
    {
        return view('livewire.modules.search.show');
    }
}
