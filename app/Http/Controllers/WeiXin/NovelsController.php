<?php

namespace App\Http\Controllers\WeiXin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NovelsController extends Controller
{


    public function __construct()
    {

    }

    public function index(){

      return view('weixin.index');
    }


    public function info(){

      return view('weixin.info');
    }

}
