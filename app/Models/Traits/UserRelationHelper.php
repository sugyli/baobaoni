<?php namespace App\Models\Traits;

use App\Models\User;
use App\Models\Message;
use App\Models\Trash;
use App\Models\Bookcase;
use App\Models\Qiandao;
//use App\Models\Article;
use App\Models\Ranking;
trait UserRelationHelper
{

  public function relationQiandao()
  {
      return $this->hasOne(Qiandao::class ,'uid' ,'uid');
  }
  //第三个参数为中间模型的外键名称 而第四个参数为最终模型的外键名称，第五个参数则为本地键。
  public function relationRankings($articleid,$date)
  {
      return $this->hasMany(Ranking::class ,'uid' ,'uid')
                    ->where('articleid',$articleid)
                    ->where('ranking_date',$date)
                    ->first();
  }

  //关联收件箱  如果当属性用就是不加（）就是对象 加了是个关联的关系
  public function relationInboxs()
  {

      return $this->hasMany(Message::class ,'toid' ,'uid');
  }
    //第2个参数是 关联类的外键   第3个是 本类中
  public function relationOutboxs()
  {

      return $this->hasMany(Message::class ,'fromid' ,'uid');
  }

  public function relationBookcases()
  {
    //第2个参数是 关联类的外键   第3个是 本类中
      return $this->hasMany(Bookcase::class ,'userid' ,'uid');
  }
  /**
   * 获取所有附件。
   */
  public function trashs()
  {
      return $this->morphMany(Trash::class, 'trashestable');
  }

}
