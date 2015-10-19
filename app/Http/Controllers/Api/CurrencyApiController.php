<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Own\Repositories\CurrencyBatchRepo\CurrencyBatchRepo;
use App\Own\Repositories\AvailableCurrenciesRepo\AvailableCurrenciesRepo;
use App\Own\Currency\RatePreparer;

class CurrencyApiController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function latest(CurrencyBatchRepo $repo, RatePreparer $rate)
    {
        return json_encode($rate->prepareToApi($repo->lastTwo()));
    }

    public function converter(CurrencyPriceRepo $repo, RatePreparer $rate)
    {
        return json_encode($rate->prepareToConverter($repo->fetchWithHeaders()));
    }

    public function available(AvailableCurrenciesRepo $repo)
    {
        return json_encode($repo->get());
    }

}
