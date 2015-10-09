<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailableCurrency extends Model
{
    protected $table = 'available_currencies';

    public function prices()
    {
        return $this->hasMany('App\CurrencyPrice', 'available_currency_ticker');
    }
}
