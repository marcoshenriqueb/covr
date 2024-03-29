<?php

namespace App\Own\Repositories\ChatRepo;

use App\Chat;
use App\Own\Auth\UserAuth as Auth;

/**
 *
 */
interface ChatRepo
{
  public function __construct(Auth $auth);

  public function storeChat($user);

  public function checkIfChatExists($user);

  public function getMessagesFromChat($id, $skip = 0, $take = 15);

  public function getChats();

  public function getChatOtherUserId($id);

  public function getNotRead();

  public function destroy($id);
}
 
