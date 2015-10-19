<?php

namespace App\Own\Repositories\BidSearchRepo;

use App\Bid;
use App\Own\Auth\UserAuth as Auth;

/**
 *
 */
interface BidSearchRepo
{
  public function __construct(Auth $auth);

  public function getBidsAndOffers($options = []);

}
