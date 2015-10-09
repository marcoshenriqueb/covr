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
     if ($request->input('place_id') != null) {
       $bid->place_id = $request->input('place_id');
     }else {
       $pId = (array) json_decode(Auth::user()->place_id);
       if (count($pId) > 0) {
         $bid->place_id = $pId;
       }else {
         return response()->json(['address' => [0 => 'Favor colocar uma localização.']], 403);
       }
     }
     if ($request->input('address') != null) {
       $bid->address = $request->input('address');
     }else {
       $bid->address = Auth::user()->localizacao;
     }
     if(Auth::user()->bids()->save($bid)){
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
