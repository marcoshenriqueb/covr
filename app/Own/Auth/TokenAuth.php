<?php

namespace App\Own\Auth;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Cookie\CookieJar;
use App\User;

/**
 *
 */
class TokenAuth implements UserAuth
{

  public $JWTCookie;
  public $cookies;

  public function __construct(Request $request, CookieJar $cookies)
  {
    $this->JWTCookie = $request->cookie('COVR');
    $this->cookies = $cookies;
  }

  public function auth($request){
    $credentials = $request->only('email', 'password');
    try {
      if (! $token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => 'Credenciais inválidas'], 401);
      }
    } catch (JWTException $e) {
      return response()->json(['error' => 'Não foi possível criar o token'], 500);
    }
    return response()->json($token)->withCookie('COVR', $token);
  }

  public function fbAuth($user){
    $token = JWTAuth::fromUser($user);
    return response()->json($token)->withCookie('COVR', $token);
  }

  public function userFromCookie()
  {
    return JWTAuth::toUser($this->JWTCookie);
  }

  public function idFromCookie()
  {
    $user = JWTAuth::toUser($this->JWTCookie);
    return $user->id;
  }

  public function checkFromCookie()
  {
    try {
      $user = JWTAuth::toUser($this->JWTCookie);

      if ($user instanceof User) {
        return true;
      }
      return false;
    } catch (JWTException $e) {
      return false;
    }
  }

  public function token()
  {
    return $this->JWTCookie;
  }

  public function logout()
  {
    return $this->cookies->forget('COVR');
  }

  public static function check()
  {
    try {
      if (! $user = JWTAuth::parseToken()->authenticate()) {
        return response()->json(['user_not_found'], 404);
      }
    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
      return response()->json(['token_expired'], $e->getStatusCode());
    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
      return response()->json(['token_invalid'], $e->getStatusCode());
    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
      return response()->json(['token_absent'], $e->getStatusCode());
    }
    // the token is valid and we have found the user via the sub claim
    return json_encode(true);
  }

  public static function id()
  {
    $user = JWTAuth::parseToken()->authenticate();
    return $user->id;
  }

  public static function user()
  {
    return JWTAuth::parseToken()->authenticate();
  }
}
