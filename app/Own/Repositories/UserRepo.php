<?php

namespace App\Own\Repositories;

use App\User;

/**
 *
 */
class UserRepo
{

  public function registerUser($request)
  {
    $user = new User();
    $user->nome = $request->input('nome');
    $user->sobrenome = $request->input('sobrenome');
    $user->email = $request->input('email');
    $user->password = $request->input('password');
    if ($result = $user->save()) {
      return $result;
    }

    return $result;
  }

}
