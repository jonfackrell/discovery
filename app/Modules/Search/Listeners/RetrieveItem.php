<?php

namespace App\Modules\Search\Listeners;

use App\Modules\Search\Events\ItemLiked;
use App\Modules\Search\Indexes\Manager;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RetrieveItem implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ItemLiked  $event
     * @return void
     */
    public function handle(ItemLiked $event)
    {
        $item = Manager::get($event->like->index)->retrieve($event->like->database . '|' . $event->like->an);
        $event->like->data = $item;
        $event->like->save();
    }
}
