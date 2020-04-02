<?php

namespace App\Modules\Search\Console\Commands;

use App\Modules\Search\Indexes\EDS;
use App\Modules\Search\Indexes\Manager;
use Illuminate\Console\Command;

class Retrieve extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'retrieve {query}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve Record from EDS API';

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
        $this->info('You are retrieving: ' . $query);

        list($index, $id) = explode(':', $query);
        $this->info(Manager::get($index)->retrieve($id));

    }
}
