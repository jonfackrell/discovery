<?php

namespace App\Modules\Search\Events;

use App\FolderItem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ItemAddedToFolder
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $folderitem;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(FolderItem $folderitem)
    {
        $this->folderitem = $folderitem;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
