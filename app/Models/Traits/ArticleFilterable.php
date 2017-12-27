<?php
namespace App\Models\Traits;
use App\Models\Ranking;
use Carbon\Carbon;
trait ArticleFilterable
{
  public function getArticlesWithFilter($filter, $limit = 20)
  {
      $filter = $this->getArticleFilter($filter);

      return $this->applyFilter($filter,$limit);


  }
  public function getArticleFilter($filter)
  {
      $filters = ['newbook','monthhit','weekhit','dayhit','weixin_hit','weixin_tuijian','weixin_newbook'];
      if (in_array($filter, $filters)) {
          return $filter;
      }
      return 'default';
  }

  public function getArticleFilterName($filter)
  {

      if($filter == 'newbook'){
         return '最新入库';
      }
      if($filter == 'monthhit'){
         return '月推荐榜';
      }
      if($filter == 'weekhit'){
         return '周推荐榜';
      }
      if($filter == 'dayhit'){
         return '日推荐榜';
      }
      return '最新更新';
  }



  public function applyFilter($filter,$limit)
  {
    $query = $this->getBasicsBook();

    switch ($filter) {

      case 'newbook':
          return $query ->orderBy('postdate', 'desc')->remember(config('app.cacheTime_d'))->paginate($limit);
          break;
      case 'monthhit':
          $dt = Carbon::now();
          return Ranking::select(\DB::raw('sum(hits) as h,articleid'))
                          ->whereYear('created_at', $dt->year)
                          ->whereMonth('created_at', $dt->month)
                          ->groupBy('articleid')
                          ->orderBy('h', 'desc')
                          ->with(['relationArticles'=> function ($q) { $q->remember(config('app.cacheTime_d'));}])
                          ->remember(config('app.cacheTime_z'))->paginate($limit);
          break;

      case 'weekhit':
          $week_begin = mktime(0, 0, 0,date("m"),date("d")-date("w")+1,date("Y"));
          $week_end = mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y"));
          return
                  Ranking::select(\DB::raw('sum(hits) as h,articleid'))
                          //->whereYear('created_at', '2016')
                          //->whereMonth('created_at', '9')
                          ->whereBetween('ranking_date', [$week_begin, $week_end])
                          ->groupBy('articleid')
                          ->orderBy('h', 'desc')
                          ->with(['relationArticles'=> function ($q) { $q->remember(config('app.cacheTime_d'));}])
                          ->remember(config('app.cacheTime_z'))->paginate($limit);
          break;

      case 'dayhit':
          $date = date("Y-m-d",time());
          $date = strtotime($date);
          return
                  Ranking::select(\DB::raw('sum(hits) as h,articleid'))
                          ->where('ranking_date', $date)
                          ->groupBy('articleid')
                          ->orderBy('h', 'desc')
                          ->with(['relationArticles'=> function ($q) { $q->remember(config('app.cacheTime_d'));}])
                          ->remember(config('app.cacheTime_z'))->paginate($limit);
          break;

      case 'weixin_hit':
          $week_begin = mktime(0, 0, 0,date("m"),date("d")-date("w")+1,date("Y"));
          $week_end = mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y"));
          return
                  Ranking::select(\DB::raw('sum(hits) as h,articleid'))
                          //->whereYear('created_at', '2016')
                          //->whereMonth('created_at', '9')
                          ->whereBetween('ranking_date', [$week_begin, $week_end])
                          ->groupBy('articleid')
                          ->orderBy('h', 'desc')
                          ->with(['relationArticles'=> function ($q) { $q->where('is_weixin',1)->remember(config('app.cacheTime_d'));}])
                          ->remember(config('app.cacheTime_z'))->paginate($limit);
          break;
      case 'weixin_tuijian':
          return $query->where('is_weixin',1)
                        ->where('is_weixin_recommend',1)
                        ->orderBy('articleid', 'desc')
                        ->remember(config('app.cacheTime_d'))
                        ->paginate($limit);
          break;
      case 'weixin_newbook':
          return $query->where('is_weixin',1)
                        ->orderBy('lastupdate', 'desc')
                        ->remember(config('app.cacheTime_d'))
                        ->paginate($limit);
          break;
      default:
          return $query->orderBy('lastupdate', 'desc')->remember(config('app.cacheTime_d'))->paginate($limit);
          break;

    }


  }






}







 ?>
