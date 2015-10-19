<?php

namespace App\Own\Repositories\UserRepo;

use App\User;
use App\Own\Auth\UserAuth as Auth;

/**
 *
 */
interface UserRepo
{

  public function __construct(Auth $auth);

  public function getUser();

  public function editNome($request);

  public function editSobrenome($request);

  public function editLocalizacao($request);

  public function editProfilePic($profilePic);

  public function editProfilePicFromUserEmail($request);

  public function profilePicIsNotNull();

  public function profilePicIsNotNullFromEmail($request);

  public function registerUser($request);

  public function confirmUser($token);

  public function registerFbUser($request);

  public function updateFbUser($request);

  public function exists($request);

  public function fbRegistered($request);

  public function findOrCreate($request);

  public function destroy();

}
