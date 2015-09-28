<?php

namespace App\Own\Repositories;

use App\User;
use Auth;

/**
 *
 */
class FriendsRepo
{
  public function getFriends()
  {
    return Auth::user()->friends()->get();
  }

  public function getRequests()
  {
    return Auth::user()->requests()->get();
  }

  public function getRequested()
  {
    return Auth::user()->requested()->get();
  }

  public function getNotFriends()
  {
    $not_friends = User::where('id', '!=', Auth::user()->id);
    if (Auth::user()->friends->count() || Auth::user()->requests->count() || Auth::user()->requested->count()) {
      $not_friends->whereNotIn('id', Auth::user()->friends->modelKeys());
      $not_friends->whereNotIn('id', Auth::user()->requests->modelKeys());
      $not_friends->whereNotIn('id', Auth::user()->requested->modelKeys());
    }
    return $not_friends->get();
  }

  public function requestFriend($request)
  {
    $friend = User::find($request->input('id'));
    Auth::user()->requestFriend($friend);
    return true;
  }

  public function confirmFriend($request)
  {
    $friend = User::find($request->input('id'));
    $friend->removeRequest(Auth::user());
    Auth::user()->confirmFriend($friend);
    return true;
  }

  public function removeRequest($request)
  {
    $friend = User::find($request->input('id'));
    $friend->removeRequest(Auth::user());
    return true;
  }

  public function cancelRequest($request)
  {
    $friend = User::find($request->input('id'));
    Auth::user()->removeRequest($friend);
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
