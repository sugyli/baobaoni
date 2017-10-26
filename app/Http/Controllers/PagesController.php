<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\NovelsController\ArticlesController;

class PagesController extends Controller
{

    public function home()
    {
      $url = request()->url();

      $weburi = get_sys_set('weburi');
      $wapuri = get_sys_set('wapuri');

      if(str_is($url.'*', $weburi) || str_is($url.'*', $wapuri)){

          return $this->novel();

      }
      return $this->mySoftware();
    }

    protected function novel()
    {
        return app(ArticlesController::class)->index();
    }


    protected function mySoftware()
    {
        dd('not_novel');
    }



}
