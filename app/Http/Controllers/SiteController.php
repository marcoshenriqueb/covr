<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserCadastroRequest;
use App\Own\Auth\OwnAuthUser;
use App\Own\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use Auth;

class SiteController extends Controller
{
    private $autentica;

    public function __construct(OwnAuthUser $autentica){
      $this->autentica = $autentica;
    }

    public function index()
    {
      $data = [];
      if (Auth::check()) {
        $data['user'] = Auth::user();
      }
      return view('app', $data);
    }

    public function postLogin(Request $request)
    {
      return json_encode($this->autentica->auth($request));
    }

    public function postRegister(UserCadastroRequest $request, UserRepo $user)
    {
      $u = $user->registerUser($request);
      return json_encode($this->autentica->auth($request));
    }
}
