<?php

namespace App\Http\Livewire\Modules\Search;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class Marc extends Component
{
    public $record;

    protected $listeners = [
        'showMarcRecord',
    ];

    public function render()
    {
        return view('livewire.modules.search.marc');
    }

    public function showMarcRecord($bib)
    {
        $response = Http::withHeaders([
            'x-sirs-clientID' => 'DS_CLIENT',
            'SD-Preferred-Role' => 'GUEST',
            'sd-originating-app-id' => 'showmarc',
        ])->get("https://hrzweb.byui.edu:8443/hzws/catalog/bib/key/$bib", [
            'includeFields' => '*',
        ]);

        if ($response->ok()) {
            $this->record = $response->json();
        }
    }
}
