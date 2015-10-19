<?php

namespace App\Own\Repositories\MessageRepo;

use App\Message;
use App\Chat;
use App\Own\Auth\UserAuth as Auth;

/**
 *
 */
class EloquentMessageRepo implements MessageRepo
{
  private $auth;

  public function __construct(Auth $auth)
  {
    $this->auth = $auth;
  }

  public function storeMessage($request)
  {
    $message = new Message();
    $message->message = $request->input('message');
    $message->user_id = $request->input('user_id');
    $message->chat_id = $request->input('chat_id');
    if($result = $message->save())
    {
        return $message;
    }
    return $result;
  }

  public function updateRead($request)
  {
     $chat = Chat::find($request->input('id'));
     return $chat->messages()->whereNotIn('user_id', [$this->auth->id()])->update(['read' => 1]);
  }
}
