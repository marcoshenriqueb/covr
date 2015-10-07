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
    if ($fetch && $fetch->count() == 1) {
      $options['headers'] = ['If-None-Match' => $fetch['eTag'], 'If-Modified-Since' => $fetch['date']];
    }else {
      $options = [];
    }
    return $this->fetch(env('BASE_CURRENCY_ADDRESS'), 'latest.json', env('API_CURRENCY_KEY'), $options);

  }
}
