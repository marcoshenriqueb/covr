<?php

namespace App\Own\Repositories\AvailableCurrenciesRepo;

use App\AvailableCurrency;
/**
 *
 */
class EloquentAvailableCurrenciesRepo implements AvailableCurrenciesRepo
{

  public function get()
  {
    return AvailableCurrency::all();
  }

}
