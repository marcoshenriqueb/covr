<?php

namespace App\Own\Repositories\ImageRepo;

use Intervention\Image\Facades\Image;
use App\Own\Auth\UserAuth as Auth;
use Illuminate\Support\Facades\Storage;

/**
 *
 */
interface ImageRepo
{
  public function __construct(Auth $auth);

  function storeDropzonePic($file);

  function resizeProfileImage($image);

  function deleteImageIfExists($image);
}
