<?php

namespace App\Http\Livewire\Modules\Search;

use App\FolderItem;
use App\Folder;
use App\Modules\Search\Events\ItemAddedToFolder;
use Livewire\Component;

class BulkAction extends Component
{

    public $selected = [];
    public $records = [];
    public $folders = [];
    public $shares = [];

    protected $listeners = [
        'select',
        'bulkSelect',
    ];

    public function render()
    {
        if(auth()->check()) {
            $this->folders = auth()->user()->folders;
            $this->shares = auth()->user()->shares;
        }
        return view('livewire.modules.search.bulk-action');
    }

    public function select($checked, $index, $database, $an){
        if($checked) {
            $this->selected[$index . ':' . $database . ':' . $an] = [
                'index' => $index,
                'database' => $database,
                'an' => $an,
            ];
        }else{
            unset($this->selected[$index . ':' . $database . ':' . $an]);
        }
    }

    public function bulkSelect($checked, $items){
        foreach($items as $key => $item){
            if($checked) {
                $this->selected[$key] = [
                    'index' => $item['index'],
                    'database' => $item['database'],
                    'an' => $item['an'],
                ];
            }else{
                unset($this->selected[$key]);
            }
        }
    }

    public function folderCreated($data)
    {
        $folder = Folder::create(['name' => $data['folder_name'], 'user_id' => auth()->user()->id]);
        //auth()->user()->folders()->save($folder);
        $this->folders[] = $folder->toArray();

        foreach($this->selected as $item){
            $up = new FolderItem();
            $up->index = $item['index'];
            $up->database = $item['database'];
            $up->an = $item['an'];
            $up->folder_id = $folder->id;
            $up->user_id = auth()->user()->id;
            $up->save();
            event(new ItemAddedToFolder($up));
            $this->emit('refreshFolders');
        }

    }

    public function refreshFolders()
    {
        $this->render();
    }

    public function toggleFolder($folder)
    {
        foreach($this->selected as $item) {
            if (FolderItem::where('user_id', auth()->user()->id)
                ->where('index', $item['index'])
                ->where('database', $item['database'])
                ->where('an', $item['an'])
                ->where('folder_id', $folder)
                ->first()) {
                FolderItem::where('user_id', auth()->user()->id)
                    ->where('index', $item['index'])
                    ->where('database', $item['database'])
                    ->where('an', $item['an'])
                    ->where('folder_id', $folder)
                    ->delete();
            } else {
                $up = new FolderItem();
                $up->index = $item['index'];
                $up->database = $item['database'];
                $up->an = $item['an'];
                $up->folder_id = $folder;
                $up->user_id = auth()->user()->id;
                $up->save();
                event(new ItemAddedToFolder($up));
            }
        }
    }
}
