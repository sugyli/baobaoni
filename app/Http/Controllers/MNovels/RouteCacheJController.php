<?php

namespace App\Http\Controllers\MNovels;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteCacheJController extends Controller
{
    public function cache1(){

      $bid = request()->bid;
      $bakUrl = route('mnovels.info', ['bid' => $bid]);
      return redirect($bakUrl, 301);

    }

    public function cache2(){

      $bid = request()->bid;
      $id = request()->id;
      $bakUrl = route('mnovels.newmulu', ['bid' => $bid , 'id'=>$id]);
      return redirect($bakUrl, 301);

    }

}
