<?php

use Illuminate\Database\Seeder;

class AvailableCurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('available_currencies')->insert([
        'currency' => 'Dólar Americano',
        'ticker' => 'USD'
      ]);
      DB::table('available_currencies')->insert([
        'currency' => 'Dólar Canadense',
        'ticker' => 'CAD'
      ]);
      DB::table('available_currencies')->insert([
        'currency' => 'Dólar Australiano',
        'ticker' => 'AUD'
      ]);
      DB::table('available_currencies')->insert([
        'currency' => 'Euro',
        'ticker' => 'EUR'
      ]);
      DB::table('available_currencies')->insert([
        'currency' => 'Libra Esterlina',
        'ticker' => 'GBP'
      ]);
      DB::table('available_currencies')->insert([
        'currency' => 'Peso Chileno',
        'ticker' => 'CLP'
      ]);
      DB::table('available_currencies')->insert([
        'currency' => 'Peso Argentino',
        'ticker' => 'ARS'
      ]);
      DB::table('available_currencies')->insert([
        'currency' => 'Peso Mexicano',
        'ticker' => 'MXN'
      ]);
    }
}
