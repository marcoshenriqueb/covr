<?php

namespace App\Own\Repositories;

use App\Bid;
use Auth;

/**
 *
 */
class BidSearchRepo
{

  private $user;
  private $bids;
  private $distance = 100;
  private $skip = 0;
  private $take = 12;
  private $friends = 0;

  public function getBidsAndOffers($options = [])
  {
    $this->user = Auth::user();
    $this->bids = $this->user->bids()->orderBy('created_at', 'desc')->get();
    $this->setSearchParameters($options);
    $results = [];
    foreach ($this->bids as $k => $bid) {
      $results[$k]['bid'] = $bid;
      if ($this->friends == 1) {
        $results[$k]['offers'] = $this->getBestOffersFromFriends($bid);
      }else {
        $results[$k]['offers'] = $this->getBestOffers($bid);
      }
    }

    return $results;
  }

  private function getBestOffers($bid)
  {
    return $bid->searchRadius($this->distance, $this->user->id)
      ->skip($this->skip)
      ->take($this->take)
      ->get()->toArray();
  }

  private function getBestOffersFromFriends($bid)
  {
    return $bid->searchFriendsRadius($this->distance, $this->user)
      ->skip($this->skip)
      ->take($this->take)
      ->get()->toArray();
  }

  private function setSearchParameters($options)
  {
    foreach ($options as $property => $option) {
      if (property_exists($this, $property)) {
        $this->{$property} = $option;
      }
    }
  }
}
