<?php

namespace App\Own\Repositories\MessageRepo;

use App\Message;
use App\Chat;
use App\Own\Auth\UserAuth as Auth;

/**
 *
 */
interface MessageRepo
{
  public function __construct(Auth $auth);

  public function storeMessage($request);

  public function updateRead($request);
}
