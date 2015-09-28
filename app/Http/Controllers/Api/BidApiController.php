<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Own\GMaps\DistanceMatrix;
use App\Http\Requests\BidCadastroRequest;
use App\Own\Repositories\BidsRepo;

class BidApiController extends Controller
{
    public function distance (DistanceMatrix $dm)
    {
        return $dm->calculateDistance('-23.000434,-43.398604', '-22.977362,-43.218359|-22.911759,-43.169594');
    }

    public function store(BidCadastroRequest $request, BidsRepo $repo)
    {
        return $repo->store($request);
    }
}
