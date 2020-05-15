<?php

namespace App\Http\Livewire\Modules\Search;

use App\Modules\Search\Indexes\Manager;
use Livewire\Component;

class Citations extends Component
{
    public $index;
    public $database;
    public $an;
    public $citations = [];

    protected $listeners = [
        'cite',
    ];

    public function render()
    {
        return view('livewire.modules.search.citations');
    }

    public function cite($index, $database, $an)
    {
        $this->index = $index;
        $this->database = $database;
        $this->an = $an;
        $this->citations =  Manager::get($index)->citations($database, $an);
    }
}
