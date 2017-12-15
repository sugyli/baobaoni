<?php

namespace App\Http\Controllers\Novels;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Article;
use App\Models\Chapter;
use Cache;
use App\Models\Ranking;
class NovelsController extends Controller
{


    public function __construct()
    {

    }
    public function index(){
      /*
      $article = app(Article::class);
      $newBookDatas = $article->getArticlesWithFilter('newbook',6);
      $daydates = $article->getArticlesWithFilter('dayhit',6);
      $weekdates = $article->getArticlesWithFilter('weekhit',6);
      $monthdates = $article->getArticlesWithFilter('monthhit',6);
      $updataBooks = $article->getArticlesWithFilter('updatebook',10);
      */
      return view('novels.index');
    }


}
