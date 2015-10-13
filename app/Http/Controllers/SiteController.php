<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserCadastroRequest;
use App\Own\Auth\UserAuth;
use App\Own\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use App\Own\Mailer\AppMailer;
use App\Http\Requests\SignUserRequest;
use Auth;

class SiteController extends Controller
{
    private $autentica;

    public function __construct(UserAuth $autentica){
      $this->autentica = $autentica;
    }

    public function index()
    {
      if ($this->autentica->checkFromCookie()) {
        return view('covr', [
          'user' => $this->autentica->userFromCookie(),
          'JWTtoken' => $this->autentica->token()
        ]);
      }
      return view('covr');
    }

    public function postLogin(SignUserRequest $request)
    {
      return $this->autentica->auth($request);
    }

    public function postFbLogin(Request $request, UserRepo $user)
    {
      $u = $user->findOrCreate($request);
      return $this->autentica->fbAuth($u);
    }

    public function postRegister(UserCadastroRequest $request, UserRepo $user, AppMailer $mailer)
    {
      $u = $user->registerUser($request);
      $mailer->sendEmailConfirmationTo($u);
      return json_encode(true);
    }

    public function confirmRegister($confirmToken, UserRepo $user)
    {
      $u = $user->confirmUser($confirmToken);

      if ($u) {
        return redirect('login');
      }
      return redirect('404');
    }

    public function authCheck()
    {
      $response = $this->autentica->check();
      if (json_decode($response) == true) {
        return response('Ok', 200);
      }else {
        return $response;
      }
    }

    public function getLogout()
    {
      $cookie = $this->autentica->logout();
      return redirect('/')->withCookie($cookie);
    }

    public function fbRegisterProfilePic(Request $request, UserRepo $user)
    {
        if ($user->profilePicIsNotNullFromEmail($request)) {
          return json_encode(true);
        }else {
          return json_encode($user->editProfilePicFromUserEmail($request));
        }
    }

}
