<?php

namespace App\Modules\Search\Indexes;

use App\Item;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use JanDrda\LaravelGoogleCustomSearchEngine\LaravelGoogleCustomSearchEngine;

class Google implements IndexInterface
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
    }

    public function isAvailable()
    {
        return (env('GOOGLE_SEARCH_API_KEY') !== null);
    }

    public function search($query, array $options = [])
    {
        $fulltext = new LaravelGoogleCustomSearchEngine(); // initialize
        $results = $fulltext->getResults($query); // get first 10 results for query 'some phrase'

        $items =  collect([]);
        foreach ($results as $key => $record) {
            $items->put('Google_' . $key, new Item([
                'index' => 'Google',
                'name' => $this->getName($record),
                'author' => $this->getAuthor($record),
                'relevancy' => count($results) - $key,
            ]));
        }

        return $items;
    }

    private function getName($record)
    {
        $name = '';
        try {
            $name = $record->title;
        } catch (\Exception $e) {
        }
        return $name;
    }

    private function getAuthor($record)
    {
        $author = '';
        try {
            $author = $record->displayLink;
        } catch (\Exception $e) {
        }
        return $author;
    }
}
