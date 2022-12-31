<?php

namespace App\Helper;

use App\Helper\Uuid;

class Storage
{
    public static function uploadImageUser($fileImage)
    {
      $ext = $fileImage->getClientOriginalExtension();
      $name = UUid::createNameForImage($ext);
      $fileImage->move(base_path("public/assets/img/user"), $name);

      return $name;
    }

    public static function uploadImageObat($fileImage)
    {
      $ext = $fileImage->getClientOriginalExtension();
      $name = UUid::createNameForImage($ext);
      $fileImage->move(base_path("public/assets/img/obat"), $name);

      return $name;
    }

    public static function getLinkImageUser($name)
    {
        return url('/assets/img/user/'.$name);
    }

    public static function getLinkImageObat($name)
    {
        return url('/assets/img/obat/'.$name);
    }
}
