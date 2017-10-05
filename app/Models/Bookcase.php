<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class Bookcase extends Model
{
  protected $table = 'jieqi_article_bookcase';
  protected $primaryKey = 'caseid';

  /**
 * 为路由模型获取键名
 *
 * @return string
 */
    public function getRouteKeyName()
    {
        return 'caseid';
    }


  /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
  //public $timestamps = false;
  public function relationArticles()
  {
    //第2个参数是 chapter类的外键   第3个是 本类中articleid

      return $this->hasOne(Article::class ,'articleid' ,'articleid');

  }
  public function relationChapters()
  {
    //第2个参数是 chapter类的外键   第3个是 本类中articleid
      return $this->hasOne(Chapter::class ,'chapterid' ,'chapterid')
                  ->where('articleid',$this->articleid);
  }


}
