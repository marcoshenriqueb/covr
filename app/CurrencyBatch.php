<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyBatch extends Model
{
    protected $table = 'currencies_batch';

    public function prices()
    {
        return $this->hasMany('App\CurrencyPrice', 'currency_batch_id');
    }

    public function pricesWithNames()
    {
        return $this->prices()
          ->join('available_currencies', 'currency_prices.available_currency_ticker', '=', 'available_currencies.ticker')
          ->select('currency_prices.available_currency_ticker', 'currency_prices.price', 'available_currencies.currency');
    }
}
