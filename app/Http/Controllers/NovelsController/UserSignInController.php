<?php

namespace App\Http\Controllers\NovelsController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
class UserSignInController extends Controller
{



    public function show(){

      if(\Agent::isMobile()){

          return $this->isMobileShow();
      }

      return $this->isDesktopShow();
    }

    public function isMobileShow()
    {

      return view('wapdashubao.userqiandao');


    }

    public function isDesktopShow()
    {
      $title = date('Y年m月d日 H时',time());
      $date = getdate(strtotime(date('Y-m-d')));
      $end = getdate(mktime(0, 0, 0, $date['mon'] + 1, 1, $date['year']) - 1);
      $start = getdate(mktime(0, 0, 0, $date['mon'], 1, $date['year']));
      $pre = date('Y-m-d', $start[0] - 1);
      $next = date('Y-m-d', $end[0] + 86400);
      $arr_tpl = array(0 => '', 1 => '', 2 => '', 3 => '', 4 => '', 5 => '', 6 => '');
      $date_arr = array();
      $j = 0;
      for ($i = 0; $i < $end['mday']; $i++) {
      	if (!isset($date_arr[$j])) {
      		$date_arr[$j] = $arr_tpl;
      	}
      	$date_arr[$j][($i+$start['wday'])%7] = $i+1;
      	if ($date_arr[$j][6]) {
      		$j++;
      	}
      }
      $qiandao = Auth::user()->relationQiandao;
      $bili = get_sys_set('bili');//就是天数乘以这个数字，得到最终积分数
      $maxnums = get_sys_set('qiandao_maxnums');//连续奖励最高可获得的积分
      $newUser = get_sys_set('qiandao_newuser');//新签到用户获取积分数
      if(!empty($qiandao)){
      	$jifenNums = ($qiandao['lianxu_days']+1)*$bili;
      	if($jifenNums>$maxnums) $jifenNums = $maxnums;
      }else{
      	$jifenNums = $newUser;
      }
      //检测用户今天是否已经签到
      $todaydate = date('Y-m-d',time());  //获取今天的日期
      $todayunix = strtotime($todaydate);
      $isqiandao = false;
      if(isset($qiandao->id)){
        $isqiandao = ($qiandao['last_dateline'] > $todayunix) ? true : false;
      }

      return view('webdashubao.userqiandao',compact('title','date_arr','date','qiandao','jifenNums','isqiandao'));
    }

    public function update()
    {

        //连续签到奖励的积分，按照天来增加
        $bili = get_sys_set('bili');//就是天数乘以这个数字，得到最终积分数
        $maxnums = get_sys_set('qiandao_maxnums');//连续奖励最高可获得的积分
        $newUser = get_sys_set('qiandao_newuser');//新签到用户获取积分数
        $nowtime = time();
        $user = Auth::user();
        $qiandao = $user->relationQiandao;
        //检测用户今天是否已经签到
        $todaydate = date('Y-m-d',time());  //获取今天的日期
        $todayunix = strtotime($todaydate);
        $m = "签到失败了";
        if ($qiandao) {
            if ($qiandao->last_dateline > $todayunix) {
                $m = '您今天已经签过到了！';
                session()->flash('message', $m);
                return redirect()->back();
            }

            $lastqiandaomonth = date('Y-m',$qiandao->last_dateline);
            $thismonth = date('Y-m', $nowtime);
            $lastqiandaounix = strtotime($lastqiandaomonth);

            $thisunix = strtotime($thismonth);

          	$lastqiandaodate = date('Y-m-d',$qiandao->last_dateline);
          	$thisdate = date('Y-m-d', $nowtime);
          	$lastqiandaodateunix = strtotime($lastqiandaodate);
          	$thisdateunix = strtotime($thisdate);
            //奖励积分数
          	$jifenNums = $qiandao->lianxu_days*$bili;
          	if($jifenNums>$maxnums) $jifenNums = $maxnums;

            if($lastqiandaounix == $thisunix){//如果是当前月份
          		if(($thisdateunix-$lastqiandaodateunix)<'172800'){//如果是连续天数签到
                $qiandao->batchAssignment($nowtime);
                $user->increment('score', $jifenNums);
                $m = '感谢您连续签到'.$qiandao->lianxu_days.'天，奖励经验'. $jifenNums .'点';
                session()->flash('message', $m);
          		}else{
                $qiandao->batchAssignment($nowtime ,false);
                $user->increment('score', $jifenNums);
                $m = '感谢您的签到，连续签到有奖励哦！奖励经验'.$jifenNums.'点';
                session()->flash('message', $m);
          		}
          	}else{
          		//如果不是当前月份
          		if(($thisdateunix-$lastqiandaodateunix)<'172800'){//如果是连续天数签到
                $qiandao->batchAssignment($nowtime ,true, false);
                $user->increment('score', $jifenNums);
                $m = '感谢您连续签到'.$qiandao->lianxu_days.'天，奖励经验'.$jifenNums.'点';
                session()->flash('message', $m );
          		}else{
                $qiandao->batchAssignment($nowtime ,false, false);
                $user->increment('score', $jifenNums);
                $m = '感谢您的签到，连续签到有奖励哦！奖励经验'.$jifenNums.'点';
                session()->flash('message', $m );

          		}
          	}


        }else{
            $user->relationQiandao()->create([
                          'username' => $user->uname,
                          'lianxu_days' => 1,
                          'month_days' => 1,
                          'last_dateline' => $nowtime,
                          'alldays' => 1,
                      ]);


            $user->increment('score', $newUser);
            $m = '您是新签到用户，奖励经验'.$newUser.'点';
            session()->flash('message', $m);
        }
        if(request()->ajax()){
          return response()->json(['message'=>$m]);
        }
        return redirect()->back();

    }
}
