<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Traits\UserRelationHelper;
class User extends Authenticatable
{
    use Notifiable , UserRelationHelper;
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
    protected $appends = ['loginname','caption'];
    public function getLoginnameAttribute()
    {
        return  $this->attributes['loginname']  = empty($this->attributes['name']) ? $this->attributes['uname'] : $this->attributes['name'];
    }
    public function getCaptionAttribute()
    {
        $honor = $this->getUserHonor();
        return  $honor->caption;
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


    public function getNameAttribute($value)
    {
        return empty($this->attributes['name']) ? '未填' : $this->attributes['name'];
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
    //主要为了兼容验证password
    public function getPortraitAttribute($value)
    {
        return empty($value) ? '/webdashubao/images/noavatar.jpg' : $value;
    }
    
    public function getMobileAttribute($value)
    {
        return empty($value) ? '未填' : $value;
    }

    public function scopeByEmail($query ,$token)
    {
        return $query->where('email', $token);
    }

    //获取用户等级
    public function getUserHonor()
    {
      return getUserHonor($this);
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


}
