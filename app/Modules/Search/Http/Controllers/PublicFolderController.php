<?php

namespace App\Modules\Search\Http\Controllers;

use App\Folder;
use App\FolderItem;
use Illuminate\Http\Request;

class PublicFolderController extends Controller
{
    /**
     * Show search results.
     *
     * @return View
     */
    public function __invoke(Request $request, Folder $folder)
    {
        $items = [];
        $folder->load('folders');
        $folderItems = FolderItem::whereIn('folder_id', array_merge([$folder->id], $folder->folders->pluck('id')->all()))
                                    ->paginate(25);

        foreach ($folderItems as $folderItem) {
            if (!empty($folderItem->data)) {
                $items[] = (new \App\Modules\Search\Models\EDS\Item())->setRecord($folderItem->data);
            }
        }

        return view('livewire.modules.search.public-folder', [
            'folder' => $folder,
            'items' => $items,
            'folderItems' => $folderItems,
        ]);
    }
}
