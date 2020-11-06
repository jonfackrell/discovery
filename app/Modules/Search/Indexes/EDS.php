<?php

namespace App\Modules\Search\Indexes;

use App\Modules\Search\Models\Facet;
use App\Modules\Search\Models\Index;
use App\Modules\Search\Models\Item;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EDS implements IndexInterface
{
    private $baseUri;
    private $headers;
    private $userid;
    private $password;
    private $profile;
    private $org;
    private $authToken;
    private $authTimeout;
    private $sessionToken;

    public function __construct()
    {
        $this->userid = env('EDS_USERID');
        $this->password = env('EDS_PASSWORD');
        $this->profile = env('EDS_PROFILE');
        $this->org = env('EDS_ORG');
        $this->baseUri = 'https://eds-api.ebscohost.com/';

        $this->headers = [
            'Content-Type' => 'application/json',
        ];

        $this->getAuthToken();
        $this->getSessionToken();
    }

    public function isAvailable()
    {
        return (env('EDS_USERID') !== null) & (env('EDS_PASSWORD') !== null) & (env('EDS_PROFILE') !== null) & (env('EDS_ORG') !== null);
    }

    public function search($query, array $options = [])
    {
        $params = $this->buildRequest($query, $options);
        //dd($params);
        $response = Http::withHeaders($this->headers)->post(
            $this->baseUri . 'edsapi/rest/Search',
            $params
        );
        //logger()->info($response->json());
        //dd($response->json());
        $results = [
            'stats' => [
                'total' => null,
                'time' => null,
            ],
            'records' => collect([]),
            'facets' => [],
            'criteria' => [
                'dates' => [
                    'min' => null,
                    'max' => null,
                ]
            ],
        ];
        //dd($response);
        $items =  collect([]);
        if ($response->ok()) {
            if (!array_key_exists('Records', $response->json()['SearchResult']['Data'])) {
                return $results;
            }
            //Log::info($response->json()['SearchResult']['Data']);
            $facets = [];
            $books = 0;
            $ebooks = 0;
            $printbooks = 0;
            foreach ($response->json()['SearchResult']['AvailableFacets'] as $facet) {
                $values = collect($facet['AvailableFacetValues'])->map(function ($value) {
                    return [
                        'name' => $value['Value'],
                        'count' => $value['Count'],
                        'action' => trim(explode(':', $value['AddAction'])[1], ")"),
                    ];
                });

                if ($facet['Label'] == 'Source Type') {
                    //dd($values->where('name', 'EBooks')->first()['count']);
                    try {
                        $books = $values->where('name', 'Books')->first()['count'];
                    } catch (\Exception $exception) {
                        $books = null;
                    }
                    try {
                        $ebooks = $values->where('name', 'eBooks')->first()['count'];
                    } catch (\Exception $exception) {
                        $ebooks = null;
                    }
                    if (is_null($books)) {
                        $printbooks = 0;
                    } elseif (is_null($ebooks)) {
                        $printbooks = $books;
                    } else {
                        $printbooks = $books - $ebooks;
                    }
                    if ($printbooks > 0) {
                        $values->push([
                            'name' => 'Print Books',
                            'count' => $books - $ebooks,
                            'action' => 'Print Books',
                        ]);
                        $values = $values->sortByDesc('count')->values();
                    }
                }

                $facets[$facet['Id']] = (new Facet(['identifier' => $facet['Id'], 'name' => $facet['Label']]))->setRelation('values', $values);
            }

            $results['facets'] = $facets;
            $results['stats']['total'] = $response->json()['SearchResult']['Statistics']['TotalHits'];
            $results['stats']['total'] = $response->json()['SearchResult']['Statistics']['TotalHits'];
            $results['date_range']['min'] = explode('-', $response->json()['SearchResult']['AvailableCriteria']['DateRange']['MinDate'])[0];
            $results['date_range']['max'] = explode('-', $response->json()['SearchResult']['AvailableCriteria']['DateRange']['MaxDate'])[0];

            $records = collect($response->json()['SearchResult']['Data']['Records']);
            //$min = $records->min('Header.RelevancyScore');
            //$max = $records->max('Header.RelevancyScore');
            foreach ($records as $key => $record) {
                //$relevancy = (($max-$min)>0)?intval((($record['Header']['RelevancyScore'] - $min)/($max - $min)) * 100):100;
                $results['records']->put($key, (new \App\Modules\Search\Models\EDS\Item())->setRecord($record));
            }
        } elseif ($response->status() == 400) {
            session()->forget('session_token');
            $this->getSessionToken();
            return $this->search($query, $options);
        }

        return $results;
    }

    public function retrieve($id)
    {
        list($database, $an) = explode('|', $id);

        $response = Http::withHeaders($this->headers)->post(
            $this->baseUri . 'edsapi/rest/Retrieve',
            [
                'DbId' => $database,
                'An' => $an,
                'EbookPreferredFormat' => 'ebook-epub',
            ]
        );

        if ($response->ok()) {
            return $response->json()['Record'];
        } elseif ($response->status() == 400) {
            session()->forget('session_token');
            $this->getSessionToken();
            return $this->retrieve($id);
        } else {
            dd($response->body());
        }
    }



    public function info()
    {
        if ($info = Index::where('name', 'EDS')->first()->info) {
            logger()->info('Info retrieved from DB.');
            return $info;
        }

        $response = Http::withHeaders($this->headers)->get($this->baseUri . 'edsapi/rest/Info');

        if ($response->ok()) {
            //return $response->json();

            logger()->info('Info retrieved from API.');
            $index = Index::where('name', 'EDS')->first();
            $index->info = $response->json();
            $index->save();
            return $index->info;
        } elseif ($response->status() == 400) {
            session()->forget('session_token');
            $this->getSessionToken();
            return $this->info();
        } else {
            dd($response->body());
        }
    }

    public function citations($database, $an, $styles = null)
    {
        if (is_null($styles)) {
            $styles = explode('|', setting('citation_styles'));
        }
        $styles = implode(',', $styles);

        $response = Http::withHeaders($this->headers)->get(
            $this->baseUri . 'edsapi/rest/CitationStyles',
            [
                'dbid' => $database,
                'an' => $an,
                'styles' => $styles,
            ]
        );

        if ($response->ok()) {
            return $response->json()['Citations'];
        } elseif ($response->status() == 400) {
            session()->forget('session_token');
            $this->getSessionToken();
            return $this->citations($database, $an, explode(',', $styles));
        } else {
            dd($response->body());
        }
    }

    public function export($database, $an, $format = ['ris'])
    {
        $format = implode(',', $format);

        $response = Http::withHeaders($this->headers)->get(
            $this->baseUri . 'edsapi/rest/ExportFormat',
            [
                'dbid' => $database,
                'an' => $an,
                'format' => $format,
            ]
        );

        if ($response->ok()) {
            return $response->json();
        } elseif ($response->status() == 400) {
            session()->forget('session_token');
            $this->getSessionToken();
            return $this->export($database, $an, explode(',', $format));
        } else {
            dd($response->body());
        }
    }

    private function buildRequest($query, $options)
    {
        $queries = [];
        $facets = [];
        $actions = [];
        $limiters = [];
        $expanders = [];

        $expanders[] = 'fulltext';
        if (array_key_exists('period', $options) && !empty($options['period'])) {
            $actions[] = "AddLimiter(DT1:" . $options['period']['min'] . '/' . $options['period']['max'] . ")";
        }
        if (array_key_exists('field', $options) && !empty($options['field']) && $options['field'] != 'KW') {
            $actions[] = "AddLimiter(" .$options['field'] . ":" . $query . ")";
        }
        if (!is_null($options['language']) && !empty($options['language'])) {
            $options['facets'][] = "Language:" . Str::lower($options['language']);
        }
        if ($options['thesaurus'] == true) {
            $expanders[] = 'thesaurus';
        }
        if ($options['rel_subjects'] == true) {
            $expanders[] = 'relatedsubjects';
        }
        /*
        if(!is_null($options['collection']) && !empty($options['collection'])){
            $limiters[] = [
                'Id' => 'GZ',
                'Values' => [
                    $options['collection']
                ]
            ];
        }*/
        if (!is_null($options['type']) && !empty($options['type'])) {
            $options['facets'][] = "SourceType:{$options['type']}";
        }
        if (is_array($options['facets']) && count($options['facets']) > 0) {
            /*foreach($options['facets'] as $facet){
                $facets[] = "AddFacetFilter(" . $facet . "),";
            }*/
            $setLanguage = true;
            foreach ($options['facets'] as $key => $facet) {
                if (Str::startsWith($facet, 'Language')) {
                    $setLanguage = false;
                }
                if (Str::startsWith($facet, 'SourceType') && Str::endsWith($facet, 'Print Books')) {
                    $query .= ' AND ((PT Book NOT PT eBook)';
                    unset($options['facets'][$key]);
                }
            }
            if ($setLanguage && empty($options['language'])) {
                $options['facets'][] = "Language:english";
            }

            $facets[] = "AddFacetFilter(2," . implode(',', $options['facets']) . ")";
        } else {
            if (empty($options['language'])) {
                $options['facets'][] = "Language:english";
                $facets[] = "AddFacetFilter(2," . implode(',', $options['facets']) . ")";
            }
        }
        //dd($facets);
        if (array_key_exists('fullText', $options) && $options['fullText'] == 'true') {
            $actions[] = 'AddExpander(fulltext)';
        }
        if (array_key_exists('peerReviewed', $options) && $options['peerReviewed'] == 'true') {
            $actions[] = 'AddLimiter(RV:y)';
        }
        if (array_key_exists('available', $options) && $options['available'] == 'true') {
            $actions[] = 'AddLimiter(FT1:y)';
        } elseif (!array_key_exists('available', $options)) {
            $actions[] = 'AddLimiter(FT1:y)';
        }
        if (array_key_exists('page', $options) && !is_null($options['page'])) {
            $page = $options['page'];
            $actions[] = 'GoToPage(' . $options['page'] . ')';
        } else {
            $page = 1;
        }
        if (array_key_exists('queries', $options)) {
            foreach ($options['queries'] as $q) {
                if (!is_null($q['tag']) && strlen($q['term']) > 0) {
                    $queries[] = "AddQuery({$q['operation']},{$q['tag']}:{$q['term']})";
                }
            }
        }

        $params = [
            'SearchCriteria' => [
                'Queries' => [
                    [
                        'Term' => $query
                    ]
                ],
                "SearchMode" => $options['mode'],
                "IncludeFacets" => "y",
                "Sort" => "relevance",
                "AutoSuggest" => "y",
                "AutoCorrect" => "y",
                "Limiters" => $limiters,
                "Expanders" => $expanders,

            ],
            "RetrievalCriteria" => [
                "View" => (in_array(setting('display'), ['standard', 'expanded']))?'detailed':'brief',
                "ResultsPerPage" => setting('count'),
                "PageNumber" => $page,
                "Highlight" => "y",
                "IncludeImageQuickView" => "n"
            ],
            "Actions" => array_merge($queries, $facets, $actions)

        ];

        //dd($params);
        return $params;
    }

    private function getAuthToken()
    {
        $index = Index::where('name', 'EDS')->first();
        if ($index->auth_token_expires_at > now()) {
            $authToken = $index->auth_token;
            $authTimeout = $index->auth_token_expires_at;
        } else {
            $response = Http::withHeaders($this->headers)->post($this->baseUri . 'authservice/rest/UIDAuth', [
                'UserId' => $this->userid,
                'Password' => $this->password,
            ]);
            $authToken = $response->json()['AuthToken'];
            $authTimeout = $response->json()['AuthTimeout'];
            $index->update([
                'auth_token' => $authToken,
                'auth_token_expires_at' => now()->addSeconds($authTimeout),
            ]);
        }

        $this->authToken = $authToken;
        $this->authTimeout = $authTimeout;
        $this->headers['x-authenticationToken'] = $authToken;
    }

    private function getSessionToken()
    {
        if (session('session_token')) {
            $sessionToken = session('session_token');
        } else {
            $response = Http::withHeaders($this->headers)->post($this->baseUri . 'edsapi/rest/createsession', [
                'Profile' => $this->profile,
                'Org' => $this->org
            ]);

            if ($response->ok()) {
                $sessionToken = $response->json()['SessionToken'];
                session(['session_token' => $sessionToken]);
            }
        }

        $this->sessionToken = $sessionToken;
        $this->headers['x-sessionToken'] = $sessionToken;
    }
}
