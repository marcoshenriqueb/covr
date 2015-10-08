<?php

namespace App\Own\Repositories;

use App\Message;
use App\Chat;
use Auth;

/**
 *
 */
class MessageRepo
{

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
     return $chat->messages()->whereNotIn('user_id', [Auth::id()])->update(['read' => 1]);
  }
}
