<?php

namespace App\Modules\Search\Console\Commands;

use App\Modules\Search\Indexes\EDS;
use App\Modules\Search\Indexes\Manager;
use Illuminate\Console\Command;

class Search extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search {query}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Search EDS API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $query = $this->argument('query');
        $this->info('You are searching: ' . $query);

        // get all managers
        // Loop through managers to get search results
        // combine search results
        $indexes = collect([]);
        foreach (['EDS', 'Google'] as $index) {
            $indexes = $indexes->merge(Manager::get($index)->search($query));
        }
        // TODO: process other elements such as facets
        foreach ($indexes->sortByDesc('relevancy') as $key => $item) {
            $this->info('Index: '  . $item->index . ' | Relevancy: '  . $item->relevancy . ' | Title: ' . $item->name);
        }
    }
}
