<?php

namespace App\Http\Controllers\NovelsController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteCacheJController extends Controller
{
    public function cache1(){

      $bid = request()->bid;
      $bakUrl = route('web.articles.show', ['bid' => $bid]);
      return redirect($bakUrl, 301);

    }

    public function cache2(){
      $id = request()->id;
      $bakUrl = route('web.articles.fenlei', ['id' => $id]);
      return redirect($bakUrl, 301);

    }

    public function cache3(){
      $bid = request()->bid;
      $cid = request()->cid;
      $bakUrl = route('web.articles.content', ['bid' => $bid ,'cid' => $cid]);
      return redirect($bakUrl, 301);

    }

}
