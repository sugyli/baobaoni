<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\MNovels\NovelsController;
use App\Http\Controllers\Novels\NovelsController as webindex;
use App\Http\Controllers\WeiXin\NovelsController as weixinindex;
class PagesController extends Controller
{

    public function home()
    {
      $url = request()->url();

      $weburl = config('app.url_web');
      $wapurl = config('app.url_wap');
      $weixinurl = config('app.url_weixin');
      /*
      if(str_is($url.'*', $weixinurl)){
          return app(weixinindex::class)->index();;
      }
      */
      if(str_is($url.'*', $weburl)){
          dd('开发中');
          //return app(webindex::class)->index();
          //return app(weixinindex::class)->index();;
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
