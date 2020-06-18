<?php

namespace App\Http\Livewire\Modules\Search;

use App\Enums\Thumbnail;
use App\Modules\Search\Indexes\Manager;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{
    public $advanced = false;
    public $info = [];
    public $term = '';
    public $field = null;
    public $term_2 = '';
    public $field_2 = null;
    public $term_3 = '';
    public $field_3 = null;
    public $page = 1;
    public $facet = [];
    public $period = null;
    public $from = null;
    public $to = null;
    public $items = [];
    public $facets = [];
    public $readyToLoad = false;
    public $fullText = false;
    public $peerReviewed = false;
    public $available = true;
    public $total = 0;
    public $type = null;
    public $collection = null;
    public $language = null;
    public $count = null;
    public $mode = null;
    public $thesaurus = null;
    public $rel_subjects = null;

    private $noSearchingRequired;

    protected $updatesQueryString = [
        'advanced',
        'term',
        'field',
        'term_2',
        'field_2',
        'term_3',
        'field_3',
        'facet',
        'period',
        'from',
        'to',
        'fullText',
        'peerReviewed',
        'available',
        'page',
        'type',
        'collection',
        'language',
        'count',
        'mode',
        'thesaurus',
        'rel_subjects',
        ];

    protected $listeners = [
        'setFormatFacet',
        'setContentProviderFacet',
        'toggleAvancedSearch',
        ];

    public function mount()
    {
        $this->advanced = request('advanced');
        $this->type = request('type');
        $this->collection = request('collection');
        $this->language = request('language');
        $this->count = request('count', setting('count'));
        $this->term = request('term');
        $this->field = request('field');
        $this->term_2 = request('term_2');
        $this->field_2 = request('field_2');
        $this->term_3 = request('term_3');
        $this->field_3 = request('field_3');
        $this->page = request('page', 1);
        $this->facet = request('facet', []);
        $this->period = request('period');
        $this->from = request('from');
        $this->to = request('to');
        $this->fullText = request('fullText')=='true'?:null;
        $this->peerReviewed = request('peerReviewed')=='true'?:null;
        $this->available = request('available')=='false'?:true;
        $this->mode = request('mode', setting('mode'));
        $this->thesaurus = request('thesaurus')=='true'?:null;
        $this->rel_subjects = request('rel_subjects')=='true'?:null;
    }

    public function loadResults()
    {
        $this->readyToLoad = true;
    }

    public function updatingFacet($value)
    {
        $this->page = 1;
    }

    /*public function updatingFullText($value)
    {
        $this->facet = [];
    }

    public function updatingPeerReviewed($value)
    {
        $this->facet = [];
    }

    public function updatingAvailable($value)
    {
        $this->facet = [];
    }*/

    public function render()
    {
        if ($this->noSearchingRequired) {
            $this->noSearchingRequired = false;
        } elseif ($this->readyToLoad && $this->hasTerm()) {
            /*if(env('CACHE_RESULTS') == true && session('search_results') == base64_encode()){
                $items = session('items');
                $facets = session('facets');
                $this->items = $items;
                $this->facets = $facets;
            }else{*/
            $this->searchIndexes();

            $this->emit('resetSelectAll');

            /* if(env('CACHE_RESULTS') == true){
                 session(['search_results' => base64_encode(url()->full())]);
                 session(['items' => $this->items]);
                 session(['facets' => $this->facets]);
             }

            }*/
        }

        if ($this->advanced) {
            if (session('info')) {
                $this->info = session('info');
            } else {
                $this->info = Manager::get('EDS')->info();
                session(['info' => $this->info]);
            }
        }

        return view('livewire.modules.search.index');
    }

    public function search($data)
    {
        $this->facet = [];
        $this->facets = [];
        $this->emit('clearFacets');
        $this->page = 1;
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
        if ($this->thesaurus == 'false') {
            $this->thesaurus = null;
        }
        if ($this->rel_subjects == 'false') {
            $this->rel_subjects = null;
        }
    }

    public function searchIndexes()
    {
        // get all managers
        // Loop through managers to get search results
        // combine search results
        $indexes = collect([]);
        $results = collect([]);
        $facets = collect([]);
        $this->items = [];
        $this->total = 0;

        $appliedFacets = [];
        $id = 1;
        foreach ($this->facet as $fskey => $fs) {
            foreach ($fs as $fkey => $f) {
                if ($f == 'true' || $f == true) {
                    $appliedFacets[] = "$fskey:$fkey";
                    $id++;
                } else {
                    $this->facet[$fskey][$fkey] = null;
                }
            }
        }
        //dd($appliedFacets);
        $total = 0;
        foreach (['EDS'] as $index) {
            $result = Manager::get($index)->search($this->term, [
                'field' => $this->field,
                'facets' => $appliedFacets,
                'period' => $this->getPeriod(),
                'peerReviewed' => $this->peerReviewed,
                'fullText' => $this->fullText,
                'available' => $this->available,
                'page' => $this->page,
                'queries' => [
                    [
                        'operation' => 'AND',
                        'tag' => $this->field_2,
                        'term' => $this->term_2,
                    ],
                    [
                        'operation' => 'AND',
                        'tag' => $this->field_3,
                        'term' => $this->term_3,
                    ],
                ],
                'type' => $this->type,
                'collection' => $this->collection,
                'language' => $this->language,
                'count' => $this->count,
                'mode' => $this->mode,
                'thesaurus' => $this->thesaurus,
                'rel_subjects' => $this->rel_subjects,
            ]);
            $indexes = $indexes->push($result);
            $results = $results->merge($result['records']);
            $facets = $facets->merge($result['facets']);
            $total += $result['stats']['total'];
        }
        $this->total = $total;
        // TODO: process other elements such as facets
        foreach ($results->sortByDesc('relevancy') as $key => $item) {
            $this->items[] = $item;
        }
        $this->facets = $facets->all();
        return $this->items;
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

    public function hasTerm()
    {
        return !is_null($this->term) && strlen($this->term) > 2;
    }

    public function setFormatFacet($format)
    {
        $this->page = 1;
        if ($format == 'Dissertation/ Thesis') {
            $this->facet['SourceType'][Str::plural('Dissertation')] = true;
        } else {
            $this->facet['SourceType'][Str::plural($format)] = true;
        }
    }

    public function setContentProviderFacet($format)
    {
        $this->page = 1;
        $this->facet['ContentProvider'][$format] = true;
    }

    public function toggleAvancedSearch()
    {
        $this->advanced = $this->advanced?false:true;
        $this->noSearchingRequired = true;
    }
}
