<?php

namespace App\Own\Auth;

use Auth;

/**
 *
 */
class OwnAuthUser
{

  public function auth($request){
    $result = Auth::attempt([
          'email' => $request->input('email'),
          'password' => $request->input('password'),
          'verified' => 1
        ], $request->has('remember'));
    if ($result) {
        return $result;
    }

    return $result;
  }

  public function fbAuth($user){
    $result = Auth::login($user, true);
    return Auth::check();
  }

}