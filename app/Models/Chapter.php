<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use SoftDeletes;
    protected $guarded = ['chapterid'];
    protected $table = 'jieqi_article_chapter';
    protected $primaryKey = 'chapterid';
    protected $visible = [
      'chapterid',
      'articleid',
      'postdate',
      'lastupdate',
      'articlename',
      'chaptername',
      'chapterorder',
      'chaptertype',
      'attachment',
      'link',

    ];

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
            $builder->where('display', '<=', '0');
        });
    }
    */
    protected $appends = ['link'];
    /**
     * 为路由模型获取键名
     *
     * @return string
     */
      public function getRouteKeyName()
      {
          return 'chapterid';
      }
      public function getLinkAttribute()
      {
        return route('novel.content', ['bid' => $this->articleid ,'cid'=>$this->chapterid]);

      }


      //前台使用
      public function scopeGetBasicsBook($query)
      {

      }
}
