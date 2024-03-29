<?php

namespace App\Own\Repositories\CurrencyBatchRepo;

use App\CurrencyBatch;
/**
 *
 */
class EloquentCurrencyBatchRepo implements CurrencyBatchRepo
{

  public function store($last)
  {
    $batch = new CurrencyBatch();
    $batch->date = $last['date'];
    $batch->eTag = $last['eTag'];
    if ($result = $batch->save()) {
      return $batch;
    }
    return $result;
  }

  public function last()
  {
    return CurrencyBatch::all()->last();
  }

  public function lastTwo()
  {
    return CurrencyBatch::orderBy('date', 'desc')->take(2)->get();
  }
}
