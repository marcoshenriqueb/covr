<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyPrice extends Model
{
    protected $table = 'currency_prices';

    public function batch()
    {
        return $this->belongsTo('App\CurrencyBatch', 'currency_batch_id');
    }

    public function currency()
    {
        return $this->belongsTo('App\AvailableCurrency', 'available_currency_ticker');
    }
}
