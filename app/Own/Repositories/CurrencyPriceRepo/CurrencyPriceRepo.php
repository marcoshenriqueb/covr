<?php

namespace App\Own\Repositories\CurrencyPriceRepo;

use App\CurrencyPrice;
/**
 *
 */
interface CurrencyPriceRepo
{

  public function savePrices($rates, $batch);

  public function fetch();

  public function fetchWithHeaders();
}
