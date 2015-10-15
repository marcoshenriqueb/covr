<?php

namespace App\Own\Repositories;

use App\Bid;
use App\Own\Auth\UserAuth as Auth;

/**
 *
 */
class BidsRepo
{
  private $auth;

  public function __construct(Auth $auth)
  {
    $this->auth = $auth;
  }

  public function store($request)
  {
     $bid = new Bid();
     $bid->operation = $request->input('operation');
     $bid->currency = $request->input('currency');
     $bid->amount = $request->input('amount');
     $bid->price = $request->input('price');
     $bid->deadline = $request->input('deadline');
     if ($request->input('place_id') != null) {
       $bid->place_id = $request->input('place_id');
     }else {
       $pId = (array) json_decode($this->auth->user()->place_id);
       if (count($pId) > 0) {
         $bid->place_id = $pId;
       }else {
         return response()->json(['address' => [0 => 'Favor colocar uma localização.']], 403);
       }
     }
     if ($request->input('address') != null) {
       $bid->address = $request->input('address');
     }else {
       $bid->address = $this->auth->user()->localizacao;
     }
     if($this->auth->user()->bids()->save($bid)){
       return $bid;
     }else {
       return false;
     }

  }


  public function getUserFromBidRequest($request)
  {
    return Bid::find($request->input('id'))->user;
  }

  public function destroy($request)
  {
    return Bid::destroy($request->input('id'));
  }
}
