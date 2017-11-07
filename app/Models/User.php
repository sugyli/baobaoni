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
        'pass', 'remember_token',
    ];
    /**
     * 访问器被附加到模型数组的形式。
     *
     * @var array
     */
    //protected $appends = ['loginname','caption'];




    //获取用户等级
    public function getUserHonor()
    {
        return getUserHonor($this);

    }
    //经典的递归
    public static function createEmail()
    {
        $token = str_random(30);
        $tokens = self::byEmail($token)->count();

        if ($tokens) {
            return self::createEmail();
        }

        return $token;
    }
    public function scopeByEmail($query ,$token)
    {
        return $query->where('email', $token);
    }

    //主要为了兼容验证password
    public function getRegdateAttribute($value)
    {
        return date("Y-m-d H:i:s",$value);
    }
    public function getPasswordAttribute()
    {
        return $this->attributes['pass'];
    }

    public function getPortraitAttribute($value)
    {
        return empty($value) ? '/images/noavatar.jpg' : $value;
    }


    public function getMobileAttribute($value)
    {
        return empty($value) ? '未填' : $value;
    }

    //保存头像
    public function savePortrait($upload_status)
    {
      Trash::where('body',$upload_status)
            ->delete();
      if ($this->portrait) {
        Trash::withTrashed()
              ->where('body',$this->portrait)
              ->restore();
      }

      $this->portrait = $upload_status;
      $this->save();
    }

    public function markAdminemailAsRead()
    {
        if($this->adminemail >= 1) {
            $this->forceFill(['adminemail' => 0])->save();
        }
    }
    public function markAdminemailAsNoRead()
    {
        if($this->adminemail < 9 ) {
            $this->increment('adminemail');
        }
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

    //第三个参数为中间模型的外键名称 而第四个参数为最终模型的外键名称，第五个参数则为本地键。
    public function relationRankings($articleid,$date)
    {
        return $this->hasMany(Ranking::class ,'uid' ,'uid')
                      ->where('articleid',$articleid)
                      ->where('ranking_date',$date)
                      ->first();
    }

}
