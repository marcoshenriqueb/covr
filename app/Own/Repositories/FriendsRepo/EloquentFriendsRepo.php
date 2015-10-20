<?php

namespace App\Own\Repositories\FriendsRepo;

use App\User;
use App\Own\Auth\UserAuth as Auth;

/**
 *
 */
class EloquentFriendsRepo implements FriendsRepo
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

  public function getNotFriends($user = null)
  {
    if ($user == null) {
      $user = $this->auth->user();
    }
    $not_friends = User::where('id', '!=', $user->id);
    if ($user->friends->count() || $user->requests->count() || $user->requested->count()) {
      $not_friends->whereNotIn('id', $user->friends->modelKeys());
      $not_friends->whereNotIn('id', $user->requests->modelKeys());
      $not_friends->whereNotIn('id', $user->requested->modelKeys());
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

  public function searchNewFriends($s)
  {
    $result = \DB::table(\DB::raw("(select id,
                                         nome,
                                         sobrenome,
                                         CONCAT_WS(' ', nome, sobrenome) AS full_name,
                                         email,
                                         localizacao
                                         from users) as users_view"))
                           ->where('id', '!=', $this->auth->user()->id)
                           ->whereNotIn('id', $this->auth->user()->friends->modelKeys())
                           ->whereNotIn('id', $this->auth->user()->requests->modelKeys())
                           ->whereNotIn('id', $this->auth->user()->requested->modelKeys())
                           ->where(function($q) use ($s){
                             $q->where('full_name', 'LIKE', "%$s%")
                               ->orWhere('email', 'LIKE', "%$s%");
                           })->get();

    return $result;
  }

  public function syncFriendsFromFb($fbFriends, $user = null)
  {
    if ($user == null) {
      $user = $this->auth->user();
    }
    $notFriends = $this->getNotFriends($user)->modelKeys();
    $requests = $user->requests->modelKeys();
    $requested = $user->requested->modelKeys();
    foreach ($fbFriends as $f) {
      $friend = User::where('fbId', $f['id'])->get()->first();
      $fId = $friend['id'];
      if (in_array($fId, $notFriends)) {
        $user->confirmFriend($friend);
      }elseif (in_array($fId, $requests)) {
        $user->removeRequest($friend);
        $user->confirmFriend($friend);
      }elseif (in_array($fId, $requested)) {
        $friend->removeRequest($user);
        $user->confirmFriend($friend);
      }
    }
  }
}
