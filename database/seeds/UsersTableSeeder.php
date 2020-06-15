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

        factory(\App\User::class, 1)->create([
            'name' => 'Evelyn Christensen',
            'email' => 'christensene@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Andrea Clements',
            'email' => 'clementsa@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Shane Cole',
            'email' => 'coles@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Chris Fox',
            'email' => 'cfox@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Laurie Francis',
            'email' => 'francisl@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Holly Green',
            'email' => 'greenh@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Cindy Jensen',
            'email' => 'jensenci@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Adam Luke',
            'email' => 'lukea@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Mat Miles',
            'email' => 'milesm@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Hannah Nelson',
            'email' => 'nelsonh@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Sam Nielson',
            'email' => 'nielsons@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Chris Olsen',
            'email' => 'olsenc@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Tyler Oswald',
            'email' => 'oswaldt@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Debora Scholes',
            'email' => 'scholesde@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Juliann Self',
            'email' => 'selfj@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Lynne Squires',
            'email' => 'squiresl@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Craig Whetten',
            'email' => 'whettenc@byui.edu',
        ]);

        factory(\App\User::class, 1)->create([
            'name' => 'Nate Wise',
            'email' => 'wisen@byui.edu',
        ]);

        factory(\App\User::class, 9)->create();
    }
}
