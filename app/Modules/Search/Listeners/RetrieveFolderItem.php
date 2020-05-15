<?php

namespace App\Modules\Search\Listeners;

use App\Modules\Search\Events\ItemAddedToFolder;
use App\Modules\Search\Indexes\Manager;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RetrieveFolderItem implements ShouldQueue
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
     * @param  RetrieveFolderItem  $event
     * @return void
     */
    public function handle(ItemAddedToFolder $event)
    {
        $item = Manager::get($event->folderitem->index)->retrieve($event->folderitem->database . '|' . $event->folderitem->an);
        $event->folderitem->data = $item;
        $event->folderitem->save();
    }
}
