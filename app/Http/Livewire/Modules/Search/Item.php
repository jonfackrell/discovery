<?php

namespace App\Http\Livewire\Modules\Search;

use App\Modules\Search\Indexes\Manager;
use App\Modules\Stackmaps\Models\Map;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Item extends Component
{

    public $index;
    public $itemId;
    public $item = null;
    public $readyToLoad = false;
    public $qrLink = '';

    public function mount()
    {
        list($this->index, $this->itemId) = explode(':', request('item'));
        //$this->item = Manager::get($this->index)->retrieve($this->itemId);
        $this->qrLink = 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&choe=UTF-8&chl=' . url()->full();
    }

    public function loadItem()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $map = null;
        if($this->readyToLoad){
            if(session($this->index.$this->itemId)){
                $record = session($this->index.$this->itemId);
            }else{
                $record = Manager::get($this->index)->retrieve($this->itemId);
                session([$this->index.$this->itemId => $record]);
            }

            $this->item = (new \App\Modules\Search\Models\EDS\Item())->setRecord($record);

            if($this->item->database == 'cat03146a' && in_array($this->item->format, ['Book', 'Map', 'Audio', 'Video Recording'])){
                list($database, $an) = explode('|', $this->itemId);
                $bib = explode('.', $this->itemId)[1];
                $response = Http::get('https://abish.byui.edu/horizon/api/index.cfm/summary/' . $bib,
                    [
                        'authorization' => env('HORIZON_API_TOKEN'),
                    ]
                );

                if($response->ok()){

                    $map = (new Map)->locate($response->json()['items'][0]['collection'], $response->json()['items'][0]['call_number']);
                }
            }
        }

        return view('livewire.modules.search.show', [
            'map' => $map,
        ]);
    }
}
