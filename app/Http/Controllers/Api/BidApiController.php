<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Own\GMaps\DistanceMatrix;
use App\Http\Requests\BidCadastroRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Own\Repositories\BidsRepo;

class BidApiController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function distance (DistanceMatrix $dm)
    {
        return $dm->calculateDistance('-23.000434,-43.398604', '-22.977362,-43.218359|-22.911759,-43.169594');
    }

    public function store(BidCadastroRequest $request, BidsRepo $repo, DistanceMatrix $dm)
    {
        return $repo->store($request);
    }

    public function index(BidsRepo $repo)
    {
        $c = $repo->getBestOffers(500);
        return json_encode($c);
    }

    public function page($index, BidsRepo $repo)
    {
        $c = $repo->getBestOffers(500, ($index - 1) * 12);
        return json_encode($c);
    }

    public function destroy(Request $request, BidsRepo $repo)
    {
        return json_encode($repo->destroy($request));
    }
}
