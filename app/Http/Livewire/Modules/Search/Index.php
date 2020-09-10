<?php

namespace App\Http\Livewire\Modules\Search;

use App\Enums\Thumbnail;
use App\Modules\Search\Indexes\EDS;
use App\Modules\Search\Indexes\Manager;
use App\Modules\Search\Models\EDS\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use JonFackrell\Eds\Facades\EbscoDiscovery;
use Livewire\Component;

class Index extends Component
{
    public $an;
    public $database;

    public $info;
    public $facet = [];
    public $facets = [];
    public $items = [];
    public $total = 0;
    public $period = null;

    public $SourceType = [];
    public $CreationDate = [];
    public $SubjectEDS = [];
    public $Publisher = [];
    public $Publication = [];
    public $Language = [];
    public $SubjectGeographic = [];
    public $Category = [];
    public $Location = [];
    public $Collection = [];
    public $ContentProvider = [];

    public $advanced = false;
    public $term = null;
    public $field = null;

    protected $updatesQueryString = [
        'an',
        'database',
        'term',
        'field',
        'period',
        'facet',
        'SourceType',
        'CreationDate',
        'SubjectEDS',
        'Publisher',
        'Publication',
        'Language',
        'SubjectGeographic',
        'Category',
        'Location',
        'Collection',
        'ContentProvider',
    ];

    protected $listeners = [
        'show',
    ];

    public function mount()
    {
        $this->an = request('an');
        $this->database = request('database');

        $this->getInfo();

        if(! empty(request('term'))){
            $request = new Request();
            $request->replace(request()->all());
            $this->getCriteria($request);
        }
    }

    public function render()
    {
        // TODO: This is where we could check a config setting to open the item in a full page or a sidebar.
        if(! empty($this->an)){
            $index = new EDS();
            $record = $index->retrieve("$this->database|$this->an");
            $item = (new Item())->setRecord($record);
            return view('Search::partials.show', [
                'item' => $item,
            ]);
        }

        $this->searchIndex();

        return view('Search::partials.results');
    }

    public function search($data)
    {

        $request = new Request();
        $request->replace($data);
        $this->getCriteria($request);
    }

    public function show($database, $an)
    {
        if('detail' && auth()->guest()){
            return redirect()->route('login');
        }

        $this->database = $database;
        $this->an = $an;
    }

    public function searchIndex()
    {
        if(empty($this->term)){
           return;
        }

        $facets = [];

        foreach($this->getFacets() as $facet){
            foreach($this->{$facet} as $value){
                $facets[] = "$facet:$value";
            }
        }

        $index = new EDS();
        $result = $index->search($this->term, [
            'field' => $this->field,
            'period' => $this->getPeriod(),
            'facets' => $facets,
            'language' => 'English',
            'mode' => 'bool',
            'rel_subjects' => true,
            'thesaurus' => true,
            'type' => null,
        ]);

        $this->facets = collect($result['facets'])->all();
        $this->items = $result['records']->all();
        $this->total = $result['stats']['total'];
    }

    public function getInfo()
    {
        $this->info = EbscoDiscovery::info();
    }

    public function getCriteria(Request $request)
    {
        foreach($request->all() as $key => $value){
            if(! empty($value)){
                $this->{$key} = $value;
            }else{
                $this->{$key} = null;
            }
        }
    }

    public function getPeriod()
    {
        if (empty($this->period)) {
            return null;
        } elseif ($this->period == 'custom') {
            return ['period' => $this->period, 'min' => $this->from, 'max' => $this->to];
        } else {
            $now = now();
            return ['period' => $this->period, 'min' => $now->subYears($this->period)->format('Y-m'), 'max' => now()->format('Y-m')];
        }
    }

    public function getFacets()
    {
        return explode('|', env('FACETS'));
    }

}
