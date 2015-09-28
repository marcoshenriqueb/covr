<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Own\Repositories\LatestCurrenciesRepo;
use App\Own\Repositories\AvailableCurrenciesRepo;
use App\Own\Currency\RatePreparer;

class CurrencyApiController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function latest(LatestCurrenciesRepo $repo, RatePreparer $rate)
    {
        return json_encode($rate->prepareToApi($repo->fetch()));
    }

    public function converter(LatestCurrenciesRepo $repo, RatePreparer $rate)
    {
        return json_encode($rate->prepareToConverter($repo->fetchWithHeaders()));
    }

    public function available(AvailableCurrenciesRepo $repo)
    {
        return json_encode($repo->get());
    }

}
