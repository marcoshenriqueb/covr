<?php

namespace App\Own\Repositories;

use App\Bid;
use App\Own\Auth\UserAuth as Auth;

/**
 *
 */
class BidSearchRepo
{

  private $auth;
  private $user;
  private $bids;
  private $distance = 100;
  private $skip = 0;
  private $take = 12;
  private $friends = 0;
  private $order = 'amount_difference';

  public function __construct(Auth $auth)
  {
    $this->auth = $auth;
  }

  public function getBidsAndOffers($options = [])
  {
    $this->user = $this->auth->user();
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
    return $bid->searchRadius($this->distance, $this->user->id, $this->order)
      ->skip($this->skip)
      ->take($this->take)
      ->get()->toArray();
  }

  private function getBestOffersFromFriends($bid)
  {
    return $bid->searchFriendsRadius($this->distance, $this->user, $this->order)
      ->skip($this->skip)
      ->take($this->take)
      ->get()->toArray();
  }

  private function setSearchParameters($options)
  {
    if (isset($options['friends'])) {
      $this->setFriends($options['friends']);
    }
    if (isset($options['distance'])) {
      $this->setDistance($options['distance']);
    }
    if (isset($options['order'])) {
      $this->setOrder($options['order']);
    }
  }

  private function setFriends($friends)
  {
    if ($friends == 1 || $friends == 0) {
      $this->friends = $friends;
    }
  }

  private function setDistance($distance)
  {
    if (is_numeric($distance) && $distance > 0) {
      $this->distance = $distance;
    }
  }

  private function setOrder($order)
  {
    if (in_array($order, ['amount_difference', 'distance', 'price'])) {
      $this->order = $order;
    }
  }
}
