<?php
namespace App\Libraries;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
class ImageRoute
{
    static public function imageStorageRoute(){

        //获取当前的url
        $realpath = str_replace('storage/','',Request::path());
        $exists = Storage::exists($realpath);
        if ($exists) {
          $url = Storage::url($realpath);
          $contents = Storage::get($realpath);
        //  $local_path = Storage::path($realpath);
          //return response()->file($local_path,['Content-type: image/jpg']);

          //输出图片
          header('Content-type: image/jpg');
          echo $contents;
          exit;

        }
        // return response()->header('Status', '404 Not Found');

        header("HTTP/1.1 404 Not Found");
        header("Status: 404 Not Found");
        exit;


    }
}
