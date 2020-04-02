<?php

namespace App\Modules\Search\Indexes;

use App\Item;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
        $params = $this->buildRequest($query);

        $response = Http::withHeaders($this->headers)->post($this->baseUri . 'edsapi/rest/Search',
            $params
        );



        $items =  collect([]);
        if($response->ok()){
            Log::info($response->json()['SearchResult']['Data']);
            $records = collect($response->json()['SearchResult']['Data']['Records']);
            $min = $records->min('Header.RelevancyScore');
            $max = $records->max('Header.RelevancyScore');
            foreach ($records as $key => $record){
                $items->put('EDS_' . $key, new \App\Modules\Search\Models\EDS\Item($record, ['relevancy' => intval((($record['Header']['RelevancyScore'] - $min)/($max - $min)) * 100)]));
            }
        }

        return $items;
    }

    public function retrieve($id)
    {
        list($database, $an) = explode('|', $id);

        $response = Http::withHeaders($this->headers)->post($this->baseUri . 'edsapi/rest/Retrieve',
            [
                'DbId' => $database,
                'An' => $an,
                'EbookPreferredFormat' => 'ebook-epub',
            ]
        );

        if($response->ok()){
            return $response->json()['Record'];
        }else{
            dd('Error');
        }
    }

    private function getName($record)
    {
        $name = '';
        try{
            $name = collect($record['Items'])->where('Name', 'Title')->first()['Data'];
        }catch(\Exception $e){

        }
        return $name;
    }

    private function getAuthor($record)
    {
        $author = '';
        try{
            $author = collect($record['Items'])->where('Name', 'Author')->first()['Data'];
        }catch(\Exception $e){

        }
        return $author;
    }

    private function buildRequest($query)
    {

        $params = [
            'SearchCriteria' => [
                'Queries' => [
                    [
                        'BooleanOperator' => 'AND',
                        'Term' => $query
                    ]
                ],
                "SearchMode" => "all",
                "IncludeFacets" => "y",
                "Sort" => "relevance",
                "AutoSuggest" => "y",
                "AutoCorrect" => "y"
            ],
            "RetrievalCriteria" => [
                "View" => "brief",
                "ResultsPerPage" => 20,
                "PageNumber" => 1,
                "Highlight" => "y",
                "IncludeImageQuickView" => "n"
            ],
            "Actions" => null
        ];

        return $params;

    }

    private function getAuthToken()
    {
        $response = Http::withHeaders($this->headers)->post($this->baseUri . 'authservice/rest/UIDAuth', [
            'UserId' => $this->userid,
            'Password' => $this->password,
        ]);

        $this->authToken = $response->json()['AuthToken'];
        $this->authTimeout = $response->json()['AuthTimeout'];
        $this->headers['x-authenticationToken'] = $this->authToken;
    }

    private function getSessionToken()
    {
        $response = Http::withHeaders($this->headers)->post($this->baseUri . 'edsapi/rest/createsession', [
            'Profile' => $this->profile,
            'Org' => $this->org
        ]);

        $this->sessionToken = $response->json()['SessionToken'];

        $this->headers['x-sessionToken'] = $this->sessionToken;
    }

}
