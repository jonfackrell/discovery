<?php

namespace App\Http\Livewire\Modules\Search;

use App\Enums\Thumbnail;
use App\Modules\Search\Indexes\EDS;
use App\Modules\Search\Indexes\Manager;
use App\Modules\Search\Models\EDS\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use JonFackrell\DiscoveryApi\Facades\Discovery;
use Livewire\Component;

class Index extends Component
{
    public $an;
    public $database;

    //public $info;
    public $count = 10;
    public $date_range = ['min' => null, 'max' => null];
    public $facet = [];
    public $facets = [];
    public $items = [];
    public $language = null;
    public $mode = 'bool';
    public $total = 0;
    public $period = null;
    public $to = null;
    public $from = null;
    public $min = null;
    public $max = null;
    public $minyear = null;
    public $maxyear = null;
    public $source_type = null;

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
    public $field = null;
    public $peer_review = false;
    public $term = null;

    protected $queryString = [
        'an',
        'database',
        'term',
        'field',
        'peer_review',
        'period',
        'from',
        'to',
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
        'setDateRange',
        'show',
    ];

    public function mount()
    {
        //$this->an = request('an');
        //$this->database = request('database');

        //$this->getInfo();

        /*if (! empty(request('term'))) {
            $request = new Request();
            $request->replace(request()->all());
            $this->getCriteria($request);
        }*/
    }

    public function render()
    {
        // TODO: This is where we could check a config setting to open the item in a full page or a sidebar.
        if (! empty($this->an)) {
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
        if ('detail' && auth()->guest()) {
            return redirect()->route('login');
        }

        $this->database = $database;
        $this->an = $an;
    }

    public function searchIndex()
    {
        if (empty($this->term)) {
            return;
        }

        $facets = [];

        foreach ($this->getFacets() as $facet) {
            foreach ($this->{$facet} as $value) {
                $facets[] = "$facet:$value";
            }
        }

        $index = new EDS();
        $result = $index->search($this->term, [
            'field' => $this->field,
            'period' => $this->getPeriod(),
            'peerReviewed' => $this->peer_review,
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
        $this->date_range = $result['date_range'];
        $this->from = $result['date_range']['min'];
        $this->to = $result['date_range']['max'];
    }

    /*public function getInfo()
    {
        $this->info = EbscoDiscovery::info();
    }*/

    public function getCriteria(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            if (! empty($value)) {
                $this->{$key} = $value;
            } else {
                $this->{$key} = null;
            }
        }
    }

    public function getPeriod()
    {
        if (empty($this->period)) {
            return null;
        } elseif (is_integer($this->period)) {
            $now = now();
            return ['period' => $this->period, 'min' => $now->subYears($this->period)->format('Y-m'), 'max' => now()->format('Y-m')];
        } elseif ($this->period == 'custom' || (! empty($this->from) && ! empty($this->to))) {
            $this->period = 'custom';
            return ['period' => $this->period, 'min' => "$this->from"."-1", 'max' => "$this->to"."-12"];
        }
    }

    public function setDateRange($params)
    {
        $this->period = $params['period'];
        $this->to = $params['to'];
        $this->from = $params['from'];
    }

    public function getFacets()
    {
        return explode('|', env('FACETS'));
    }
}
