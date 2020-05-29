<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 1)->create([
            'name' => 'Jon Fackrell',
            'email' => 'fackrellj@byui.edu',
        ]);
        factory(\App\User::class, 1)->create([
            'name' => 'Ina Rodino',
            'email' => 'rodinoi@byui.edu',
        ]);
        factory(\App\User::class, 1)->create([
            'name' => 'Katie Cagle',
            'email' => 'caglek@byui.edu',
        ]);
        factory(\App\User::class, 9)->create();
    }
}
