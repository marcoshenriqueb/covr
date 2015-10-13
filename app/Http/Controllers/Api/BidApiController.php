<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Own\GMaps\DistanceMatrix;
use App\Http\Requests\BidCadastroRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Own\Repositories\BidsRepo;
use App\Own\Repositories\BidSearchRepo;

class BidApiController extends Controller
{
    public function __construct()
    {
      $this->middleware('jwt.auth');
    }

    public function index($friends, BidSearchRepo $repo)
    {
        $c = $repo->getBidsAndOffers(['dist' => 500, 'friends' => $friends]);
        return json_encode($c);
    }

    public function page($index, $friends, BidSearchRepo $repo)
    {
        $c = $repo->getBidsAndOffers(['dist' => 500, 'skip' => ($index - 1) * 12, 'friends' => $friends]);
        return json_encode($c);
    }

    public function store(BidCadastroRequest $request, BidsRepo $repo, DistanceMatrix $dm)
    {
        return $repo->store($request);
    }

    public function destroy(Request $request, BidsRepo $repo)
    {
        return json_encode($repo->destroy($request));
    }
}
