<?php

namespace App\Http\Livewire\Modules\Search;

use App\Like;
use App\Modules\Search\Events\ItemLiked;
use App\Modules\Search\Indexes\Manager;
use App\Modules\Search\Models\EDS\Item;
use App\User;
use Livewire\Component;

class Summary extends Component
{
    public $item;
    public $folders = [];
    public $export = null;
    public $liked = false;
    public $display = false;

    public function mount(Item $item, string $display = 'summary')
    {
        $this->item = $item->toArray();
        $this->display = $display;
        /*$this->relevancy = $item->relevancy;
        $this->detail_link = $item->detail_link;
        $this->title = $item->title;
        $this->author = $item->author;
        $this->index = $item->index;
        $this->database = $item->database;
        $this->an = $item->an;*/

        /*list($this->index, $this->itemId) = explode(':', request('item'));
        $this->item = Manager::get($this->index)->retrieve($this->itemId);*/
    }

    public function render()
    {
        $this->item['liked'] = Like::where('user_id', 1)
                                    ->where('index', $this->item['index'])
                                    ->where('database', $this->item['database'])
                                    ->where('an', $this->item['an'])
                                    ->first();
        return view('livewire.modules.search.summary');
    }

    public function refreshFolders()
    {
        $this->render();
    }

    public function toggleLike($index, $database, $an)
    {
        if (Like::where('user_id', user()->id)
            ->where('index', $this->item['index'])
            ->where('database', $this->item['database'])
            ->where('an', $this->item['an'])
            ->first()) {
            Like::where('user_id', user()->id)
                ->where('index', $this->item['index'])
                ->where('database', $this->item['database'])
                ->where('an', $this->item['an'])
                ->delete();
            $this->liked = false;
        } else {
            $user = auth()->user();
            $like = new Like();
            $like->index = $index;
            $like->database = $database;
            $like->an = $an;
            $user->likes()->save($like);
            $this->liked = true;

            event(new ItemLiked($like));
        }

        //$this->emitSelf('loadSummary');
    }

    public function export($index, $database, $an)
    {
        $this->export =  Manager::get($index)->export($database, $an);
    }
}
