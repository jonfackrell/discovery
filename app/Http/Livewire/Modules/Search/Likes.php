<?php

namespace App\Http\Livewire\Modules\Search;

use Livewire\Component;

class Likes extends Component
{
    public $items = [];
    public $readyToLoad = false;
    public $total = 0;

    public function render()
    {
        if ($this->readyToLoad) {
            $likes = auth()->user()->likes;
            foreach ($likes as $like) {
                $this->items[] = (new \App\Modules\Search\Models\EDS\Item())->setRecord($like->data);
            }
            $this->total = count($this->items);
        } else {
            $this->items = [];
        }
        return view('livewire.modules.search.likes');
    }

    public function loadResults()
    {
        $this->readyToLoad = true;
    }
}
