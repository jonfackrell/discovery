<?php

namespace App\Http\Livewire\Modules\Search;

use App\Modules\Search\Events\ItemLiked;
use Livewire\Component;

class Like extends Component
{
    public $index;
    public $database;
    public $an;
    public $liked;

    protected $listeners = [
        'toggle',
    ];

    public function mount($index, $database, $an)
    {
        $this->index = $index;
        $this->database = $database;
        $this->an = $an;
    }

    public function render()
    {
        $this->liked = \App\Like::where('user_id', user()->id)
                            ->where('index', $this->index)
                            ->where('database', $this->database)
                            ->where('an', $this->an)
                            ->first();
        return view('livewire.modules.search.like');
    }

    public function toggle()
    {
        if (\App\Like::where('user_id', user()->id)
            ->where('index', $this->index)
            ->where('database', $this->database)
            ->where('an', $this->an)
            ->first()) {
            \App\Like::where('user_id', user()->id)
                ->where('index', $this->index)
                ->where('database', $this->database)
                ->where('an', $this->an)
                ->delete();
            $this->liked = false;
        } else {
            $user = auth()->user();
            $like = new \App\Like();
            $like->index = $this->index;
            $like->database = $this->database;
            $like->an = $this->an;
            $user->likes()->save($like);
            $this->liked = true;

            event(new ItemLiked($like));
        }
    }
}
