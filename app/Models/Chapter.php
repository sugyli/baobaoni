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
      'mulu',
      'updatetime'

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
    protected $appends = ['link','updatetime','mulu'];
    /**
     * 为路由模型获取键名
     *
     * @return string
     */
      public function getRouteKeyName()
      {
          return 'chapterid';
      }
      public function getMuluAttribute()
      {
        return route('mnovels.mulu',['bid'=>$this->articleid] );

      }
      public function getLinkAttribute()
      {
        return route('mnovels.content', ['bid' => $this->articleid ,'cid'=>$this->chapterid]);

      }
      public function getUpdatetimeAttribute()
      {
        return formatTime($this->attributes['lastupdate']);
      }

      //前台使用
      public function scopeGetBasicsBook($query)
      {

      }
}
