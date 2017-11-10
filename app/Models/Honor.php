<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class Honor extends Model
{
    protected $table = 'jieqi_system_honors';
    protected $primaryKey = 'honorid';
    protected $casts = [
        'setting' => 'json',
    ];

    public static function getUserHonor(User $user){

        $honor = self::getAllHonor();
        if ($honor && $honor->count() >0) {

          $filtered = $honor->first(function ($item, $key) use($user){

              return ($user->score >= $item->minscore && $user->score < $item->maxscore);

          });
          return $filtered;
        }
        throw new \Exception('请设置用户等级');
    }

    public static function getAllHonor(){
        $key = 'getHonor';
        $honor = \Cache::get($key);
        if ( !$honor ) {//不存在
            $honor = self::orderBy('maxscore', 'asc')->get();
            if ($honor->count() >0) {
              \Cache::forever($key, $honor);
            }

        }
        return $honor;
    }
}
