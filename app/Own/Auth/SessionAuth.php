<?php

namespace App\Own\Auth;

use Auth;

/**
 *
 */
class SessionAuth implements UserAuth
{

  public function auth($request){
    $result = Auth::attempt([
          'email' => $request->input('email'),
          'password' => $request->input('password'),
          'verified' => 1
        ], ($request->input('remember') != null ) ? true : false);
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
