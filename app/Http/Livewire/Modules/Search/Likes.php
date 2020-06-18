<?php

namespace App\Http\Livewire\Modules\Search;

use Livewire\Component;

class Likes extends Component
{
    public $items = [];
    public $readyToLoad = false;
    public $total = 0;
    public $count;

    public function render()
    {
        if ($this->readyToLoad) {
            $this->count = setting('count');
            $likes = auth()->user()->likes()->paginate($this->count);
            foreach ($likes as $like) {
                $this->items[] = (new \App\Modules\Search\Models\EDS\Item())->setRecord($like->data);
            }
            $this->total = $likes->total();
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
