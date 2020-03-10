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
        $index = Manager::get('EDS');
        foreach ($index->search($query) as $item){
            $this->info('Title: ' . $item->name);
        }
    }
}
