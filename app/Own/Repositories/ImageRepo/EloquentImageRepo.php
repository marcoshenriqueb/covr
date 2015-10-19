<?php

namespace App\Own\Repositories\ImageRepo;

use Intervention\Image\Facades\Image;
use App\Own\Auth\UserAuth as Auth;
use Illuminate\Support\Facades\Storage;

/**
 *
 */
class EloquentImageRepo implements ImageRepo
{
  private $auth;

  public function __construct(Auth $auth)
  {
    $this->auth = $auth;
  }

  function storeDropzonePic($file)
  {
    $oldImage = $this->auth->user()->profile_pic;
    $image['arquivo'] = time() . "-" . $this->auth->user()->nome . '-' . $this->auth->user()->sobrenome . '-' . $this->auth->id() . '.' . $file->getClientOriginalExtension();
    $image['nome'] = pathinfo($image['arquivo'])['filename'];
    try {
      if ($file->isValid())
      {
        $file->move(base_path() . '/public/images/profile/', $image['arquivo']);
        $this->deleteImageIfExists($oldImage);
        return $image;
      }else {
        throw new Exception("Arquivo não é valido!", 1);
      }
    } catch (Exception $e) {
      dd($e->getMessage());
    }
  }

  function resizeProfileImage($image)
  {
    $img = Image::make(base_path() . '/public/images/profile/' . $image['arquivo']);
    $w = $img->width();
    $h = $img->height();
    if ($w > $h) {
      $img->resize(null, 200, function ($constraint) {
        $constraint->aspectRatio();
      });
      $d = $img->width() - 200;
      $img->crop(200, 200);
    }elseif ($h > $w) {
      $img->resize(200, null, function ($constraint) {
        $constraint->aspectRatio();
      });
      $d = $img->width() - 200;
      $img->crop(200, 200);
    }else {
      $img->resize(200, 200);
    }
    $img->save(base_path() . '/public/images/profile/' . $image['arquivo'], 60);
  }

  function deleteImageIfExists($image)
  {
    if ($image != null && substr($image,0,4) != 'http') {
      if (file_exists(base_path() . '/public/' . $image)) {
        unlink(base_path() . '/public/' . $image);
      }
    }
  }
}
