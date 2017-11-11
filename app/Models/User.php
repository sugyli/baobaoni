<?php

namespace App\Models;

//use Illuminate\Notifications\Notifiable;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

//use App\Models\Traits\UserRelationHelper;
class User extends Authenticatable
{
    //use Notifiable , UserRelationHelper;
    protected $table = 'jieqi_system_users';
    protected $primaryKey = 'uid';
    protected $guarded = [];

    protected $hidden = [
        'pass', 'remember_token','api_token',
    ];

    public function getPasswordAttribute()
    {
        return $this->attributes['pass'];
    }


    public function getPortraitAttribute($value)
    {
        return empty($value) ? '/images/noavatar.jpg' : $value;
    }



    /**
     * 访问器被附加到模型数组的形式。
     *
     * @var array
     */
    //protected $appends = ['loginname','caption'];
    //经典的递归
    public static function createEmail()
    {
        $email = str_random(30);
        $emails = self::byEmail($email)->count();
        if ($emails) {
            return self::createEmail();
        }
        return $email;
    }
    public function scopeByEmail($query ,$email)
    {
        return $query->where('email', $email);
    }

    //推荐数
    public function getDayRecommendCount()
    {
      $honor = Honor::getUserHonor($this);
      return isset($honor->setting['dayrecommendcount']) ? $honor->setting['dayrecommendcount'] : config('app.dayrecommendmaxcount');
    }
    //书架数
    public function getBookcaseCount()
    {
      $honor = Honor::getUserHonor($this);
      return isset($this->setting['bookcasecount']) ? $this->setting['bookcasecount'] : config('app.bookcasemaxcount');
    }
    public function getMassageMaxCount()
    {
      $honor = Honor::getUserHonor($this);
      return isset($honor->setting['maxmessage']) ? $honor->setting['maxmessage'] : config('app.massagemaxcount');
    }
    //等级
    public function getCaption()
    {
      $honor = Honor::getUserHonor($this);
      return $honor->caption;
    }
    //设置收件箱已读
    public function markAdminemailAsRead()
    {
        if($this->adminemail >= 1) {
            $this->forceFill(['adminemail' => 0])->save();
        }
    }

    /*
    public static function createToken()
    {
        $token = str_random(64);
        $tokens = self::byToken($token)->count();

        if ($tokens) {
            return self::createToken();
        }
        return $token;
    }
    public function scopeByToken($query ,$token)
    {
        return $query->where('api_token', $token);
    }

    */


      //用户今天使用了多少票
    public function relationRankingsUseHits()
    {
      $date = date("Y-m-d",time());
      $date = strtotime($date);
      //第2个参数是 关联类的外键   第3个是 本类中
        return $this->hasMany(Ranking::class ,'uid' ,'uid')
                    ->where('ranking_date',$date)
                    ->sum('hits');
    }
    //这本书今日有没有被推荐过
    //第三个参数为中间模型的外键名称 而第四个参数为最终模型的外键名称，第五个参数则为本地键。
    public function relationRankingsTodyBookHits($articleid)
    {
      $date = date("Y-m-d",time());
      $date = strtotime($date);
        return $this->hasMany(Ranking::class ,'uid' ,'uid')
                      ->where('articleid',$articleid)
                      ->where('ranking_date',$date)
                      ->first();
    }


    public function relationBookcasesUse()
    {
        //第2个参数是 关联类的外键   第3个是 本类中
        return $this->hasMany(Bookcase::class ,'userid' ,'uid')->count();
    }
    public function relationBookcases()
    {
        //第2个参数是 关联类的外键   第3个是 本类中
        return $this->hasMany(Bookcase::class ,'userid' ,'uid');
    }

    //第2个参数是 关联类的外键   第3个是 本类中
    public function relationOutboxs()
    {
        return $this->hasMany(Message::class ,'fromid' ,'uid');
    }
    //关联收件箱  如果当属性用就是不加（）就是对象 加了是个关联的关系
    public function relationInboxs()
    {
        return $this->hasMany(Message::class ,'toid' ,'uid');
    }
}
