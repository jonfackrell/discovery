<?php

use Illuminate\Database\Seeder;

class IndexesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $index = new \App\Index();
        $index->name = 'EDS';
        $index->save();
    }
}
