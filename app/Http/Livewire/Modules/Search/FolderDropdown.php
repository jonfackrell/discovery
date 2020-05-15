<?php

namespace App\Http\Livewire\Modules\Search;

use App\Folder;
use App\FolderItem;
use App\Modules\Search\Events\ItemAddedToFolder;
use Livewire\Component;

class FolderDropdown extends Component
{

    public $index;
    public $database;
    public $an;
    public $folders = [];
    public $shares = [];
    public $user_folders = [];

    protected $listeners = [
        'folderCreated',
        'refreshFolders',
    ];

    public function mount(string $index, string $database, string $an)
    {
        $this->index = $index;
        $this->database = $database;
        $this->an = $an;
    }

    public function render()
    {
        if(auth()->check()){
            $this->folders = auth()->user()->folders;
            $this->shares = auth()->user()->shares;
        }

        $this->user_folders = FolderItem::where('index', $this->index)->where('database', $this->database)->where('an', $this->an)->where('user_id', auth()->user()->id)->pluck('folder_id')->all();
        return view('livewire.modules.search.folder-dropdown');
    }

    public function folderCreated($data)
    {
        $folder = Folder::create(['name' => $data['folder_name'], 'user_id' => auth()->user()->id]);
        //auth()->user()->folders()->save($folder);
        $this->folders[] = $folder->toArray();

        $up = new FolderItem();
        $up->index = $this->index;
        $up->database = $this->database;
        $up->an = $this->an;
        $up->folder_id = $folder->id;
        $up->user_id = auth()->user()->id;
        $up->save();

        event(new ItemAddedToFolder($up));

        $this->emit('refreshFolders');

    }

    public function refreshFolders()
    {
        $this->render();
    }

    public function toggleFolder($folder)
    {
        if(FolderItem::where('user_id', auth()->user()->id)
            ->where('index', $this->index)
            ->where('database', $this->database)
            ->where('an', $this->an)
            ->where('folder_id', $folder)
            ->first()){
            FolderItem::where('user_id', auth()->user()->id)
                ->where('index', $this->index)
                ->where('database', $this->database)
                ->where('an', $this->an)
                ->where('folder_id', $folder)
                ->delete();
        }else{
            $up = new FolderItem();
            $up->index = $this->index;
            $up->database = $this->database;
            $up->an = $this->an;
            $up->folder_id = $folder;
            $up->user_id = auth()->user()->id;
            $up->save();
            event(new ItemAddedToFolder($up));
        }

        $this->user_folders = FolderItem::where('index', $this->index)->where('database', $this->database)->where('an', $this->an)->where('user_id', auth()->user()->id)->pluck('folder_id')->all();
        //$this->emitSelf('loadSummary');
    }

}
