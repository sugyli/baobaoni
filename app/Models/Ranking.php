<?php

namespace App\Models;
use Carbon\Carbon;

class Ranking extends Model
{
    protected $guarded = ['id'];

    //获取周数据
    static public function getWeekBookHits($limit)
    {

      $week_begin = mktime(0, 0, 0,date("m"),date("d")-date("w")+1,date("Y"));
      $week_end = mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y"));
      return
              static::select(\DB::raw('sum(hits) as h,articleid'))
                      //->whereYear('created_at', '2016')
                      //->whereMonth('created_at', '9')
                      ->whereBetween('ranking_date', [$week_begin, $week_end])
                      ->groupBy('articleid')
                      ->orderBy('h', 'desc')
                      ->with(['relationArticles'])
                      ->limit($limit)
                      ->get();
    }

    //获取周数据
    static public function getMonthBookHits($limit)
    {

      $dt = Carbon::now();
      return
              static::select(\DB::raw('sum(hits) as h,articleid'))
                      ->whereYear('created_at', $dt->year)
                      ->whereMonth('created_at', $dt->month)
                      ->groupBy('articleid')
                      ->orderBy('h', 'desc')
                      ->with(['relationArticles'])
                      ->limit($limit)
                      ->get();
    }

    public function relationArticles()
    {

        return $this->hasOne(Article::class ,'articleid' ,'articleid');
    }


}
