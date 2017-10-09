<?php

namespace App\Models;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;
class Article extends Model
{
    use Traits\ArticleFilterable , SoftDeletes;
    protected $guarded = ['articleid'];
    protected $table = 'jieqi_article_article';
    protected $primaryKey = 'articleid';
    protected $hidden = ['lastupdatef'];
    /**
     * 访问器被附加到模型数组的形式。
     *
     * @var array
     */
    protected $appends = ['lastupdatef'];
    /**
     * 数据模型的启动方法
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('basic', function(Builder $builder) {
            $builder->where('lastchapterid', '>', 0);
        });
    }
    /**
   * 为路由模型获取键名
   *
   * @return string
   */
    public function getRouteKeyName()
    {
        return 'articleid';
    }
    public function getFullflagAttribute($value)
    {
        return $value > 0 ? '完本' : '连载';
    }
    public function setFullflagAttribute($value)
    {
        $this->attributes['fullflag'] = $value == '完本' ? 1 : 0;
    }

    public function getLastupdatefAttribute()
    {
        return  $this->attributes['lastupdatef']  = $this->attributes['lastupdate'] > 0 ? formatTime($this->attributes['lastupdate']) : '未知';
    }
    /*
    public function setLastupdatefAttribute($value)
    {
        $this->attributes['lastupdate'] = time();
    }
    */
    public function getImgflagAttribute($value)
    {
      return
              $value > 0 ?
                          config('app.xsfmdir')
                          . floor($this->articleid / 1000)
                          . '/' . $this->articleid . '/'
                          . $this->articleid . 's.jpg'
                        :
                          config('app.dfxsfmdir');


    }
    /*
    public function setImgflagAttribute($value)
    {
        $this->attributes['fullflag'] = empty($value) ? 0 : 1;
    }
    */
    public function link()
    {
        if (empty($this->slug)) {
            return route('web.articles.show', ['bid' => $this->articleid]);
        }

        return route('web.articles.show', ['bid' => $this->articleid ,'slug' => $this->slug]);

    }

    /*
    public function getPostdateAttribute($value)
    {
        $value =  date("Y-n-d h:i",$value);
        return \Carbon\Carbon::createFromFormat('Y-n-d h:i', $value)->diffForHumans();
    }
    */
    /**
     * 为路由模型获取键名
     *
     * @return string
     */
     /*
    public function getRouteKeyName()
    {
        return 'articleid';
    }
    */

    public function getWeekHits()
    {

      $articleid = $this->articleid;
      return
            \Cache::remember(WEEKHITS.$this->articleid, get_sys_set('cacheTime_g'), function () use ($articleid){

                              $week_begin = mktime(0, 0, 0,date("m"),date("d")-date("w")+1,date("Y"));
                              $week_end = mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y"));

                              $ranking =
                                          Ranking::select(\DB::raw('sum(hits) as h,articleid'))
                                                        ->whereBetween('ranking_date', [$week_begin, $week_end])
                                                        ->where('articleid',$articleid)
                                                        ->groupBy('articleid')
                                                        ->orderBy('h', 'desc')
                                                        ->first();
                                  if($ranking){

                                    return $ranking->h;
                                  }
                                  return 0;

                           });

    }

    public function getMonthHits()
    {

      $articleid = $this->articleid;
      return
            \Cache::remember(MONTHHITS.$this->articleid, get_sys_set('cacheTime_g'), function () use ($articleid){
                              $dt = Carbon::now();
                              $ranking =
                                          Ranking::select(\DB::raw('sum(hits) as h,articleid'))
                                                        ->whereYear('created_at', $dt->year)
                                                        ->whereMonth('created_at', $dt->month)
                                                        ->where('articleid',$articleid)
                                                        ->groupBy('articleid')
                                                        ->orderBy('h', 'desc')
                                                        ->first();
                                  if($ranking){

                                    return $ranking->h;
                                  }
                                  return 0;

                           });

    }

    public function getDayHits()
    {

      $articleid = $this->articleid;
      return
            \Cache::remember(DAYHITS.$this->articleid, get_sys_set('cacheTime_g'), function () use ($articleid){
                              $dt = Carbon::now();
                              $ranking =
                                          Ranking::select(\DB::raw('sum(hits) as h,articleid'))
                                                        ->whereYear('created_at', $dt->year)
                                                        ->whereMonth('created_at', $dt->month)
                                                        ->whereDay('created_at', $dt->day)
                                                        ->where('articleid',$articleid)
                                                        ->groupBy('articleid')
                                                        ->orderBy('h', 'desc')
                                                        ->first();
                                  if($ranking){

                                    return $ranking->h;
                                  }
                                  return 0;

                           });

    }
    public function getSort()
    {
        $sorts = get_sort('webnovel');
        if($sorts){
          return collect($sorts)->where('sortid',$this->sortid)->first();
        }
        return '';

    }

    public function relationChapters()
    {
      //第2个参数是 chapter类的外键   第3个是 本类中articleid
        return $this->hasMany(Chapter::class ,'articleid' ,'articleid')
                    //->where('display',0)
                    ->orderBy('chapterorder', 'asc')
                    ->limit(get_sys_set('maxchapter'));
    }

    public function relationBookcases($uid)
    {
        return $this->hasOne(Bookcase::class ,'articleid' ,'articleid')
                    ->where('userid',$uid)->first();
    }

    public function relationRankings($uid,$date)
    {
        return $this->hasOne(Ranking::class ,'articleid' ,'articleid')
                    ->where('uid',$uid)
                    ->where('ranking_date',$date)
                    ->first();
    }


}
