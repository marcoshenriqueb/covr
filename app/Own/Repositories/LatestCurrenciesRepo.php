<?php

namespace App\Own\Repositories;

use App\LatestCurrencies;
/**
 *
 */
class LatestCurrenciesRepo
{

  public function saveLatestCurrencies($rates)
  {
    $currency = new LatestCurrencies();
    $currency->USD = $rates['USD'];
    $currency->CAD = $rates['CAD'];
    $currency->AUD = $rates['AUD'];
    $currency->EUR = $rates['EUR'];
    $currency->GBP = $rates['GBP'];
    $currency->CLP = $rates['CLP'];
    $currency->ARS = $rates['ARS'];
    $currency->MXN = $rates['MXN'];
    $currency->eTag = $rates['eTag'];
    $currency->date = $rates['date'];
    if ($result = $currency->save()) {
      return $result;
    }
    return false;

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
