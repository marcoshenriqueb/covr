<?php

namespace App\Own\Auth;

use Auth;

/**
 *
 */
class OwnAuthUser
{

  public function auth($request){
    if ($result = Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')], $request->has('remember'))) {
        return $result;
    }

    return $result;
  }

}
