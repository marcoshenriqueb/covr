<?php

namespace App\Own\Currency;

use App\Own\Currency\CurrencyFetcher;
use App\Own\Repositories\LatestCurrenciesRepo;

/**
 *
 */
class LatestFetch extends CurrencyFetcher
{

  public function fetchLatest(){
    $repo = new LatestCurrenciesRepo();
    $fetch = $repo->fetchWithHeaders();
    $options['headers'] = ['If-None-Match' => $fetch['eTag'], 'If-Modified-Since' => $fetch['date']];
    return $this->fetch(env('BASE_CURRENCY_ADDRESS'), 'latest.json', env('API_CURRENCY_KEY'), $options);
  }
}
