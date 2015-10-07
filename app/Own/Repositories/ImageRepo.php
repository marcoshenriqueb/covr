<?php

namespace App\Own\Repositories;

use Intervention\Image\Facades\Image;
use Auth;

/**
 *
 */
class ImageRepo
{

  function storeDropzonePic($file)
  {
    $image['arquivo'] = time() . "-" . Auth::user()->nome . '-' . Auth::user()->sobrenome . '-' . Auth::id() . '.' . $file->getClientOriginalExtension();
    $image['nome'] = pathinfo($image['arquivo'])['filename'];
    try {
      if ($file->isValid())
      {
        $file->move(base_path() . '/public/images/profile/', $image['arquivo']);
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
      $img->crop(200-$d/2, 200, $d/2, 0);
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
}
