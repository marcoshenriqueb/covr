<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Own\Currency\LatestFetch;
use App\Own\Currency\RatePreparer;
use App\Own\Repositories\CurrencyPriceRepo\EloquentCurrencyPriceRepo;
use App\Own\Repositories\CurrencyBatchRepo\EloquentCurrencyBatchRepo;

class AtualizaCotacao extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $cotacao;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
      $fetch = new LatestFetch();
      $rate = new RatePreparer();
      $repo = new EloquentCurrencyPriceRepo();
      $batch = new EloquentCurrencyBatchRepo();
      $result = $fetch->fetchLatest();
      var_dump($result->getStatusCode());
      if ($result->getStatusCode() == 200) {
        $last = $rate->getRates($result);
        $repo->savePrices($last, $batch->store($last));
      }
      $cot = $rate->prepareToApi($batch->lastTwo());
      $this->cotacao = json_encode($cot);
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['cotacao'];
    }
}
