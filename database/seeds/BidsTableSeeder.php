<?php

use Illuminate\Database\Seeder;

class BidsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Bid::class, 200)->create();
    }
}
