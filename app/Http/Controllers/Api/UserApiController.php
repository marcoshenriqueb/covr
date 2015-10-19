<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Own\Repositories\UserRepo\UserRepo;
use App\Own\Repositories\ImageRepo\ImageRepo;
use App\Http\Requests\UpdateProfilePicRequest;

class UserApiController extends Controller
{

    private $user;

    public function __construct(UserRepo $user)
    {
      $this->user = $user->getUser();
      $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return json_encode($this->user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function postNome(Request $request, UserRepo $user)
    {
        $this->validate($request, [
          'nome' => 'required|min:3'
        ]);
        return json_encode($user->editNome($request));
    }

    public function postSobrenome(Request $request, UserRepo $user)
    {
        $this->validate($request, [
          'sobrenome' => 'required|min:3'
        ]);
        return json_encode($user->editSobrenome($request));
    }

    public function postLocalizacao(Request $request, UserRepo $user)
    {
        $this->validate($request, [
          'localizacao' => 'min:3'
        ]);
        return json_encode($user->editLocalizacao($request));
    }

    public function postPictureDrop(UpdateProfilePicRequest $request, ImageRepo $imageRepo, UserRepo $repo)
    {
        $image = $imageRepo->storeDropzonePic($request->file('profilePic'));
        $imageRepo->resizeProfileImage($image);
        return json_encode($repo->editProfilePic($image['arquivo']));
    }

    public function destroy(UserRepo $repo)
    {
        return $repo->destroy();
    }

}
