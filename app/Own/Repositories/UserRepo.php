<?php

namespace App\Own\Repositories;

use App\User;
use Auth;

/**
 *
 */
class UserRepo
{

  public function getUser()
  {
    return Auth::user();
  }

  public function editNome($request)
  {
    $user = Auth::user();
    $user->nome = $request->input('nome');
    if ($result = $user->save()) {
      return $user;
    }
    return $result;
  }

  public function editSobrenome($request)
  {
    $user = Auth::user();
    $user->sobrenome = $request->input('sobrenome');
    if ($result = $user->save()) {
      return $user;
    }
    return $result;
  }

  public function editLocalizacao($request)
  {
    $user = Auth::user();
    $user->localizacao = $request->input('localizacao');
    $user->place_id = $request->input('place_id');
    if ($result = $user->save()) {
      return $user;
    }
    return $result;
  }

  public function editProfilePic($profilePic)
  {
    $user = Auth::user();
    $user->profile_pic = $profilePic;
    if ($result = $user->save()) {
      return $user;
    }
    return $result;
  }

  public function profilePicIsNotNull()
  {
      $count = strlen(env('PROFILE_PIC_PATH'));
      if (isset(Auth::user()->profile_pic) && substr(Auth::user()->profile_pic, $count)) {
        return true;
      }
      return false;
  }

  public function registerUser($request)
  {
    $user = new User();
    $user->nome = $request->input('nome');
    $user->sobrenome = $request->input('sobrenome');
    $user->email = $request->input('email');
    $user->verifiedToken = str_random(30);
    $user->password = $request->input('password');
    if ($result = $user->save()) {
      return $user;
    }

    return $result;
  }

  public function confirmUser($token)
  {
    $user = User::where('verifiedToken', '=', $token)->firstOrFail();
    $user->verified = true;
    $user->verifiedToken = null;
    if ($result = $user->save()) {
      return $result;
    }

    return $result;
  }

  public function registerFbUser($request)
  {
    $user = new User();
    $user->nome = $request->input('user')['first_name'];
    $user->sobrenome = $request->input('user')['last_name'];
    $user->email = $request->input('user')['email'];
    $user->fbId = $request->input('user')['id'];
    $user->verifiedToken = null;
    $user->verified = 1;
    $user->password = $request->input('user')['id'];
    if ($result = $user->save()) {
      return $user;
    }

    return $result;
  }

  public function updateFbUser($request)
  {
    $user = User::where('email', '=', $request->input('user')['email'])->first();
    $user->fbId = $request->input('user')['id'];
    $user->verifiedToken = null;
    $user->verified = 1;
    if ($result = $user->save()) {
      return $user;
    }
    return $result;
  }

  public function exists($request)
  {
    $user = User::where('email', '=', $request->input('user')['email'])->first();
    if (isset($user) && ($user->count() > 0)) {
      return true;
    }
    return false;
  }

  public function fbRegistered($request)
  {
    $user = User::where('email', '=', $request->input('user')['email'])->first();
    if ($user->fbId != null) {
      return true;
    }
    return false;
  }

  public function findOrCreate($request)
  {
    if (!$this->exists($request)) {
      return $this->registerFbUser($request);
    }else {
      return $this->updateFbUser($request);
    }
  }

  public function destroy()
  {
      return User::destroy(Auth::id());
  }

}
