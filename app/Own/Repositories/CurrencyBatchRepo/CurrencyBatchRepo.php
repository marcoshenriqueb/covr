<?php

namespace App\Own\Repositories\CurrencyBatchRepo;

use App\CurrencyBatch;
/**
 *
 */
interface CurrencyBatchRepo
{

  public function store($last);

  public function last();

  public function lastTwo();
}
