<?php

namespace App\Own\Currency;

use App\Own\Repositories\AvailableCurrenciesRepo;

/**
 *
 */
class RatePreparer
{

  public function getRates($fetched)
  {
    $repo = new AvailableCurrenciesRepo();
    $currencies = $repo->get();
    $f = json_decode((string) $fetched->getBody())->rates;
    $rates = [];
    foreach ($currencies as $curr) {
      if ($curr->ticker == "USD") {
        $rates[$curr->ticker] = $f->BRL;
      }else {
        $rates[$curr->ticker] = $f->BRL / $f->{$curr->ticker};
      }
    }
    $rates['date'] = $fetched->getHeader('date')[0];
    $rates['eTag'] = $fetched->getHeader('etag')[0];
    return $rates;
  }

  public function prepareToApi($batchs)
  {

    $result = [];
    if ($batchs && $batchs->count() >= 2) {
      $cur = [];
      foreach ($batchs as $batch) {
        $curr[] = $batch->pricesWithNames()->get()->toArray();
      }
      foreach ($curr[0] as $key => $c) {
        $price = $c['price'];
        $priceBefore = $curr[1][$key]['price'];
        $result[$c['available_currency_ticker']] = [
          'cot' => $price,
          'var' => $price / $priceBefore - 1,
          'currency' => $c['currency']
        ];
      }
    }elseif ($batchs && $batchs->count() == 1) {
      $curr[] = $batchs[0]->pricesWithNames()->get()->toArray();
      foreach ($curr[0] as $c) {
        $result[$c['available_currency_ticker']] = [
          'cot' => $c['price'],
          'var' => 0,
          'currency' => $c['currency']
        ];
      }
    }else {
      $result = false;
    }
    return $result;
  }

  public function prepareToConverter($currencies)
  {
    $result = [];
    if ($currencies) {
      $cur = $currencies->toArray();
      foreach ($cur as $key => $c) {
        $result[$key] = $c;
      }
    }else {
      $result = false;
    }
    return $result;
  }
}
