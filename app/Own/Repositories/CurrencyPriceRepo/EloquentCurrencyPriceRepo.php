<?php

namespace App\Own\Repositories\CurrencyPriceRepo;

use App\CurrencyPrice;
/**
 *
 */
class EloquentCurrencyPriceRepo implements CurrencyPriceRepo
{

  public function savePrices($rates, $batch)
  {
    foreach ($rates as $key => $value) {
      if ($key != 'eTag' && $key != 'date') {
        $currency = new CurrencyPrice();
        $currency->price = $rates[$key];
        $currency->available_currency_ticker = $key;
        $batch->prices()->save($currency);
      }
    }
    return $batch;
  }

  public function fetch()
  {
    $result = LatestCurrencies::select(
    'USD',
    'CAD',
    'AUD',
    'EUR',
    'GBP',
    'CLP',
    'ARS',
    'MXN'
    )->orderBy('created_at', 'desc');
    if ($result) {
      return $result->take(2)->get();
    }else {
      return false;
    }
  }

  public function fetchWithHeaders()
  {
    $result = LatestCurrencies::select(
    'USD',
    'CAD',
    'AUD',
    'EUR',
    'GBP',
    'CLP',
    'ARS',
    'MXN',
    'date',
    'eTag'
    )->get();
    if ($result) {
      return $result->last();
    }else {
      return false;
    }
  }
}
