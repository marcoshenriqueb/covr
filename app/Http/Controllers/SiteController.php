<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserCadastroRequest;
use App\Own\Auth\OwnAuthUser;
use App\Own\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use App\Own\Mailer\AppMailer;
use Auth;

class SiteController extends Controller
{
    private $autentica;

    public function __construct(OwnAuthUser $autentica){
      $this->autentica = $autentica;
    }

    public function index()
    {
      return view('site');
    }

    public function postLogin(Request $request)
    {
      return json_encode($this->autentica->auth($request));
    }

    public function postFbLogin(Request $request, UserRepo $user)
    {
      $u = $user->findOrCreate($request);
      return json_encode($this->autentica->fbAuth($u));
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
      if (Auth::check()) {
        return response('Ok', 200);
      }else {
        return response('Não autorizado.', 403);
      }
    }

}
