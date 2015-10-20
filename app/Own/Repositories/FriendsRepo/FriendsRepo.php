<?php

namespace App\Own\Repositories\FriendsRepo;

use App\User;
use App\Own\Auth\UserAuth as Auth;

/**
 *
 */
interface FriendsRepo
{
  public function __construct(Auth $auth);

  public function getFriends();

  public function getRequests();

  public function getRequested();

  public function getNotFriends($user = null);

  public function requestFriend($request);

  public function confirmFriend($request);

  public function removeRequest($request);

  public function cancelRequest($request);

  public function removeFriend($request);

  public function searchNewFriends($s);

  public function syncFriendsFromFb($fbRequest, $user = null);
}
