<?php

namespace App\Own\Repositories;

use App\User;
use App\Own\Auth\UserAuth as Auth;

/**
 *
 */
class FriendsRepo
{
  private $auth;

  public function __construct(Auth $auth)
  {
    $this->auth = $auth;
  }

  public function getFriends()
  {
    return $this->auth->user()->friends()->get();
  }

  public function getRequests()
  {
    return $this->auth->user()->requests()->get();
  }

  public function getRequested()
  {
    return $this->auth->user()->requested()->get();
  }

  public function getNotFriends()
  {
    $not_friends = User::where('id', '!=', $this->auth->user()->id);
    if ($this->auth->user()->friends->count() || $this->auth->user()->requests->count() || $this->auth->user()->requested->count()) {
      $not_friends->whereNotIn('id', $this->auth->user()->friends->modelKeys());
      $not_friends->whereNotIn('id', $this->auth->user()->requests->modelKeys());
      $not_friends->whereNotIn('id', $this->auth->user()->requested->modelKeys());
    }
    return $not_friends->get();
  }

  public function requestFriend($request)
  {
    $friend = User::find($request->input('id'));
    $this->auth->user()->requestFriend($friend);
    return true;
  }

  public function confirmFriend($request)
  {
    $friend = User::find($request->input('id'));
    $friend->removeRequest($this->auth->user());
    $this->auth->user()->confirmFriend($friend);
    return true;
  }

  public function removeRequest($request)
  {
    $friend = User::find($request->input('id'));
    $friend->removeRequest($this->auth->user());
    return true;
  }

  public function cancelRequest($request)
  {
    $friend = User::find($request->input('id'));
    $this->auth->user()->removeRequest($friend);
    return true;
  }

  public function removeFriend($request)
  {
    $friend = User::find($request->input('id'));
    $this->auth->user()->removeFriend($friend);
    return true;
  }

  public function search($q)
  {
    $result = $q
      ? User::search($q)->get()->toArray()
      : false;

    return $result;
  }
}
