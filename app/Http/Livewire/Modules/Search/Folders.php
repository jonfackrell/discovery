<?php

namespace App\Http\Livewire\Modules\Search;

use App\Folder;
use App\FolderItem;
use App\Modules\Search\Indexes\Manager;
use App\User;
use Livewire\Component;
use Livewire\WithPagination;

class Folders extends Component
{
    use WithPagination;

    public $activeFolder = null;
    public $folder = null;
    public $folders = [];
    public $format = null;
    public $shares = [];
    public $items = [];
    public $page = 1;
    public $readyToLoad = false;
    public $invite = false;
    public $settings = false;
    public $cite = false;
    public $citations = [];
    public $total = 0;
    public $count;
    public $users = [];

    protected $listeners = [
        'toggleInvite',
        'toggleSettings',
        'toggleCite',
        'generateReferences',
        'shareFolderWithUser',
        'unShareFolderWithUser',
        'delete',
    ];

    public function shareFolderWithUser($data)
    {
        $folder = Folder::findOrFail($this->activeFolder);

        $folder->shares()->attach($data['user']);

        $this->users = $folder->shares;

        $this->emit('folderShared');
    }

    public function unShareFolderWithUser($user)
    {
        $folder = Folder::findOrFail($this->activeFolder);

        $folder->shares()->detach($user);

        $this->users = $folder->shares;
    }

    public function generateReferences($data)
    {
        $citations = collect([]);
        $this->format = $data['format'];
        $folderItems = FolderItem::where('user_id', auth()->user()->id)
                    ->whereIn('folder_id', array_merge([$this->activeFolder], $this->folder->folders->pluck('id')->all()))
                    ->get();

        foreach ($folderItems as $item) {
            $citation = Manager::get($item->index)->citations($item->database, $item->an, [$this->format]);
            $citations->push($citation[0]);
        }

        $citations = $citations->all();
        usort($citations, function ($item1, $item2) {
            return $item1['Data'] <=> $item2['Data'];
        });
        $this->citations = $citations;
    }

    public function updatedActiveFolder()
    {
        $this->invite = false;
        $this->settings = false;
        $this->cite = false;
        $this->citations = [];
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $this->items = [];
            $this->count = setting('count');
            $this->folders = auth()->user()->folders;

            $this->shares = auth()->user()->shares;

            if ($this->activeFolder) {
                $this->folder = Folder::with('folders')->where('id', $this->activeFolder)->first();
                $folderItems = FolderItem::where('user_id', auth()->user()->id)
                                            ->whereIn('folder_id', array_merge([$this->activeFolder], $this->folder->folders->pluck('id')->all()))
                                            ->paginate($this->count);
                $this->users = $this->folder->shares;
            } else {
                $folderItems = FolderItem::where('user_id', auth()->user()->id)->paginate($this->count);
            }

            foreach ($folderItems as $folderItem) {
                if (!empty($folderItem->data)) {
                    $this->items[] = (new \App\Modules\Search\Models\EDS\Item())->setRecord($folderItem->data);
                }
            }
            $pagination = $folderItems->links('livewire.modules.search.components.folder-pagination');
            $this->total = $folderItems->total();
        } else {
            $this->items = [];
            $folderItems = [];
            $pagination = '';
        }



        return view('livewire.modules.search.folders', [
            'items' => $this->items,
            'pagination' => $pagination,
        ]);
    }

    public function loadResults()
    {
        $this->readyToLoad = true;
    }

    public function toggleInvite($visible)
    {
        $this->settings = false;
        $this->cite = false;
        $this->invite = $this->invite?false:true;
        $this->emit('initInvite');
    }

    public function toggleSettings($visible)
    {
        $this->invite = false;
        $this->cite = false;
        $this->settings = $this->settings?false:true;
    }

    public function toggleCite($visible)
    {
        $this->invite = false;
        $this->settings = false;
        $this->cite = $this->cite?false:true;
    }

    public function delete()
    {
        $this->folder->delete();
        $this->folder = null;
        $this->activeFolder = null;

        return redirect()->to('/folders');
    }
}
