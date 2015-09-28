<?php

namespace App\Own\Repositories;

use App\Bid;
use Auth;

/**
 *
 */
class BidsRepo
{

  public function store($request)
  {
     $bid = new Bid();
     $bid->operation = $request->input('operation');
     $bid->currency = $request->input('currency');
     $bid->amount = $request->input('amount');
     $bid->price = $request->input('price');
     $bid->address = $request->input('address');
     $bid->place_id = $request->input('place_id');
     return Auth::user()->bids()->save($bid);
  }
}
