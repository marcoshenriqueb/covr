<?php

namespace App\Own\Repositories\ChatRepo;

use App\Chat;
use App\Own\Auth\UserAuth as Auth;

/**
 *
 */
class EloquentChatRepo implements ChatRepo
{
  private $auth;

  public function __construct(Auth $auth)
  {
    $this->auth = $auth;
  }

  public function storeChat($user)
  {
    $chat = new Chat();
    $chat->user_1 = $this->auth->id();
    $chat->user_2 = $user->id;
    if($result = $chat->save())
    {
        return $chat;
    }
    return $result;
  }

  public function checkIfChatExists($user)
  {
    $c1 = $this->auth->user()->chats1()->where('user_2', '=', $user->id)->get();
    $c2 = $this->auth->user()->chats2()->where('user_1', '=', $user->id)->get();
    if ($c1->count() > 0) {
      return $c1;
    }elseif ($c2->count() > 0) {
      return $c2;
    }else {
      return false;
    }
  }

  public function getMessagesFromChat($id, $skip = 0, $take = 15)
  {
    $count = Chat::find($id)->messages()->count();
    $pages = ceil($count / $take);
    $rSkip = $count - $skip - $take;
    $currPage = $skip / $take + 1;
    if ($pages > $currPage) {
      return Chat::find($id)->messages()->skip($rSkip)->take($take)->get();
    }elseif ($pages == $currPage) {
      return Chat::find($id)->messages()->skip($rSkip)->take($count % $take)->get();
    }else {
      return [];
    }
  }

  public function getChats()
  {
    $c1 = $this->auth->user()->chats1;
    $c2 = $this->auth->user()->chats2;
    $users = [];
    foreach ($c1 as $c) {
      $users[] = array_merge(
                  $c->toArray(),
                  ['user' => $c->user2->toArray()],
                  ['messages' => [$c->messages->last()]],
                  ['countNotRead' => $c->messages()->where('user_id', '<>', $this->auth->id())->where('read', 0)->count()]
                );
    }
    foreach ($c2 as $c) {
      $users[] = array_merge(
                  $c->toArray(),
                  ['user' => $c->user1->toArray()],
                  ['messages' => [$c->messages->last()]],
                  ['countNotRead' => $c->messages()->where('user_id', '<>', $this->auth->id())->where('read', 0)->count()]
                );
    }
    usort($users, function($a, $b){

      if ($a['messages'][0] != null) {
        $da = $a['messages'][0]->updated_at;
      }else {
        $da = $a['updated_at'];
      }
      if ($b['messages'][0] != null) {
        $db = $b['messages'][0]->updated_at;
      }else {
        $db = $b['updated_at'];
      }
      $d1 = new \Carbon\Carbon($da);
      $d2 = new \Carbon\Carbon($db);
      return $d1->diffInSeconds($d2, false);
    });
    return $users;
  }

  public function getChatOtherUserId($id)
  {
    $thisId = $this->auth->id();
    $chat = Chat::find($id);
    if ($chat->user_1 == $thisId) {
      return $chat->user_2;
    }else {
      return $chat->user_1;
    }
  }

  public function getNotRead()
  {
      $u = $this->auth->user();
      $messages = 0;
      foreach ($u->chats1 as $chat) {
        $messages += $chat->messages()->where('user_id', '<>', $this->auth->id())->where('read', 0)->get()->count();
      }
      foreach ($u->chats2 as $chat) {
        $messages += $chat->messages()->where('user_id', '<>', $this->auth->id())->where('read', 0)->get()->count();
      }
      return $messages;
  }

  public function destroy($id)
  {
    return Chat::destroy($id);
  }
}
 
