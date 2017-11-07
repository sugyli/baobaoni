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
    protected $appends = ['chapterlink'];
    /**
     * 为路由模型获取键名
     *
     * @return string
     */
      public function getRouteKeyName()
      {
          return 'chapterid';
      }


      public function link()
      {
        return route('web.articles.content', ['bid' => $this->articleid ,'cid'=>$this->chapterid]);

      }
      public function getChapterlinkAttribute()
      {
          return  $this->attributes['chapterlink']  =  $this->link();

      }
}
