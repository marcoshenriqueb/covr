<?php

namespace App\Own\Currency;

/**
 *
 */
class RatePreparer
{

  public function getRates($fetched)
  {
    $f = json_decode((string) $fetched->getBody())->rates;
    $rates = [];
    $rates['USD'] = $f->BRL;
    $rates['CAD'] = $f->BRL / $f->CAD;
    $rates['AUD'] = $f->BRL / $f->AUD;
    $rates['EUR'] = $f->BRL / $f->EUR;
    $rates['GBP'] = $f->BRL / $f->GBP;
    $rates['CLP'] = $f->BRL / $f->CLP;
    $rates['ARS'] = $f->BRL / $f->ARS;
    $rates['MXN'] = $f->BRL / $f->MXN;
    $rates['date'] = $fetched->getHeader('date')[0];
    $rates['eTag'] = $fetched->getHeader('etag')[0];

    return $rates;
  }

  public function prepareToApi($currencies)
  {
    $result = [];
    if ($currencies && $currencies->count() >= 2) {
      $cur = $currencies->toArray();
      foreach ($cur[0] as $key => $c) {
        $result[$key] = ['cot' => $c, 'var' => $c / $cur[1][$key] - 1];
      }
    }elseif ($currencies && $currencies->count() == 1) {
      $cur = $currencies->toArray();
      foreach ($cur[0] as $key => $c) {
        $result[$key] = ['cot' => $c, 'var' => 0];
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
