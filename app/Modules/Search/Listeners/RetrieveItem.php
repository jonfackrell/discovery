<?php

namespace App\Modules\Search\Listeners;

use App\Modules\Search\Events\ItemSaved;
use App\Modules\Search\Indexes\EDS;
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
     * @param  ItemSaved  $event
     * @return void
     */
    public function handle(ItemSaved $event)
    {
        $index = new EDS();
        $item = $index->retrieve($event->item->database.'|'.$event->item->an);
        $event->item->data = $item;
        $event->item->save();
    }
}
