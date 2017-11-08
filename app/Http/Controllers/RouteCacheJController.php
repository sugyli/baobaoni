<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteCacheJController extends Controller
{
    public function cache1(){

      $bid = request()->bid;
      $bakUrl = route('novel.info', ['bid' => $bid]);
      return redirect($bakUrl, 301);

    }

}
