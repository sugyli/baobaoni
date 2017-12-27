<?php

namespace App\Http\Controllers\WeiXin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Article;
class NovelsController extends Controller
{


    public function __construct()
    {

    }

    public function index(){

      $article = app(Article::class);
      $weixinHitDatas = $article->getArticlesWithFilter('weixin_hit',6);
      $weixinTuijianDatas = $article->getArticlesWithFilter('weixin_tuijian',9);
      $weixinNewBookDatas = $article->getArticlesWithFilter('weixin_newbook',6);
      return view('weixin.index',compact('weixinTuijianDatas','weixinHitDatas','weixinNewBookDatas'));
    }


    public function info(){

      return view('weixin.info');
    }

    public function catalog(){

      return view('weixin.catalog');
    }

    public function content(){

      return view('weixin.content');
    }

}
