<?php

namespace App\Own\Repositories\BidsRepo;

use App\Bid;
use App\Own\Auth\UserAuth as Auth;

/**
 *
 */
interface BidsRepo
{
  public function __construct(Auth $auth);

  public function store($request);


  public function getUserFromBidRequest($request);

  public function destroy($request);
}
