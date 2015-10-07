<?php

namespace App\Own\Repositories;

use App\AvailableCurrency;
/**
 *
 */
class AvailableCurrenciesRepo
{

  public function get()
  {
    return AvailableCurrency::all();
  }

}
