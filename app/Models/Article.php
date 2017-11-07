<?php

namespace App\Models;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;
//use Laravel\Scout\Searchable;
use Watson\Rememberable\Rememberable;
class Article extends Model
{
    //use Traits\ArticleFilterable ,
    use SoftDeletes ,Rememberable;
    protected $guarded = ['articleid'];
    protected $table = 'jieqi_article_article';
    protected $primaryKey = 'articleid';

    protected $visible = [
        'articleid',
        'articlename',
        'link',
        'imgflag',
        'fullflag',
        'author',
        'intro',
        'sort',
        'slug',
        'lastupdate',
        'updatetime',
        'mulu',
        'relationChapters'
      ];

    protected $appends = ['link','sort','updatetime','mulu'];
    /**
     * 数据模型的启动方法
     *
     * @return void
     */

    /*
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('basic', function(Builder $builder) {
            $builder->where('lastchapterid', '>', 0);
        });
    }
    */
    /**
   * 为路由模型获取键名
   *
   * @return string
   */
    public function getRouteKeyName()
    {
        return 'articleid';
    }

    public function getLinkAttribute()
    {
      if (empty($this->slug)) {
        return route('novel.info', ['bid' => $this->articleid]);
      }
      return route('novel.info', ['bid' => $this->articleid ,'slug' => $this->slug]);
    }
    public function getUpdatetimeAttribute()
    {
      return formatTime($this->attributes['lastupdate']);
    }

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

    public function getFullflagAttribute($value)
    {
        return $value > 0 ? '完本' : '连载';
    }

    public function getSortAttribute()
    {
        $key = (int)($this->sortid - 1);
        return config('app.fenlei')[$key] ?? '未知分类';
    }

    public function getMuluAttribute()
    {
      return route('novel.mulu',['bid'=>$this->articleid]);

    }

//关联
    public function relationChapters()
    {
      //第2个参数是 chapter类的外键   第3个是 本类中articleid
        return $this->hasMany(Chapter::class ,'articleid' ,'articleid')
                    ->where('chaptertype','<=' ,0)
                    ->orderBy('chapterorder', 'asc')
                    ->limit(config('app.maxchapter'));
    }

    public function relationBookcases($uid)
    {
        return $this->hasOne(Bookcase::class ,'articleid' ,'articleid')
                    ->where('userid',$uid)->first();
    }




    //前台使用
    public function scopeGetBasicsBook($query)
    {
        return $query->where('lastchapterid', '>', 0)
                    ->where('display', '<=', '0');
    }
}
