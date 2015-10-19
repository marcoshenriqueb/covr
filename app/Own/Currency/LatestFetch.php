<?php

namespace App\Own\Currency;

use App\Own\Currency\CurrencyFetcher;
use App\Own\Repositories\CurrencyBatchRepo\EloquentCurrencyBatchRepo;

/**
 *
 */
class LatestFetch extends CurrencyFetcher
{

  public function fetchLatest(){
    $repo = new EloquentCurrencyBatchRepo();
    $fetch = $repo->last();
    if ($fetch && $fetch->count() > 0) {
      $options['headers'] = ['If-None-Match' => $fetch->eTag, 'If-Modified-Since' => $fetch->date];
    }else {
      $options = [];
    }
    return $this->fetch(env('BASE_CURRENCY_ADDRESS'), 'latest.json', env('API_CURRENCY_KEY'), $options);

  }
}
