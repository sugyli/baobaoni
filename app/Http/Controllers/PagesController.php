<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\MNovels\NovelsController;

class PagesController extends Controller
{

    public function home()
    {
      $url = request()->url();

      $weburl = config('app.url_web');
      $wapurl = config('app.url_wap');

      if(str_is($url.'*', $weburl)){
          dd('开发中');
      }
      if(str_is($url.'*', $wapurl)){
          return $this->novelWapIndex();
      }
      dd('非法域名');
    }

    protected function novelWapIndex()
    {
        return app(NovelsController::class)->index();
    }






}
