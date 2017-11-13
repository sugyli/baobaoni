<?php

namespace App\Http\Controllers\MNovels;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Models\User;
use App\Models\Honor;
//use App\Models\Message;
use App\Models\Article;
use App\Models\Ranking;
use Illuminate\Support\MessageBag;
//use App\Http\Requests\StoreMessageRequest;
//use App\Http\Controllers\Traits\UsersTrait;
//use Illuminate\Support\Facades\Storage;
class UsersController extends Controller
{
  //  use UsersTrait;
    public function __construct()
    {

      /*
        $this->middleware('auth', [
            'except' => ['getUser']
        ]);
      */
    }

    public function show()
    {
      $user = Auth::user();
      $bkurl = request()->redirect_url ?: '/';
      return view('mnovels.usershow',compact('user','bkurl'));
    }

    public function recommend(Request $request)
    {
        $user = $request->user();
        $result = ['error'=>1,'message'=>'未知错误','bakdata'=>[]];
        if (empty($user)) {
          $result['message'] = '还没有登录';
          return response()->json($result);
        }

        $num = 1;
        $articleid = (int)$request->bid + 0 ;
        if ($articleid<=0) {
          $result['message'] = '操作非法';
          return response()->json($result);
        }
        $article  = Article::getBasicsBook()->find($articleid);
        if (empty($article)) {
          $result['message'] = '本书已经不存在了';
          return response()->json($result);
        }
        //用户拥有的今日推荐次数
        $userRecommendCount = (int)$user->getDayRecommendCount();
        //用户今天使用了多少票
        $userHits = (int)$user->relationRankingsUseHits();


        if(($userHits+$num) > $userRecommendCount){
          $result['message'] = "今日推荐票已经用完了";
          return response()->json($result);
        }
        $date = date("Y-m-d",time());
        $date = strtotime($date);
        $s = config('app.recommendscore');//增长的经验
        $s = $s * $num;
        //这本书今日有没有被推荐过
        $ranking = $user->relationRankingsTodyBookHits($articleid);
        //剩余票数
        $sheng = (int)($userRecommendCount - $num - $userHits);
        if(!$ranking){
            $data = [
              'uid'=>$user->uid,
              'articleid' => $articleid,
              'ranking_date' => $date,
              'hits' => $num,
            ];

            $bak = Ranking::create($data);

            if($bak){

              $user->increment('score' , $s);
              $result['error'] = 0;
              $result['message'] = "推荐成功,获取 {$s} 点经验 剩余 {$sheng} 票";
              //del_hits_cache($articleid);
              return response()->json($result);
            }
            $result['message'] = '推荐出错了';
            return response()->json($result);
        }
        //如果这本书已经有推荐

        $ranking->increment('hits' , $num);
        $user->increment('score' , $s);
        $result['error'] = 0;
        $result['message'] = "推荐成功！获取 {$s} 点经验 剩余 {$sheng} 票";

        //del_hits_cache($articleid);
        return response()->json($result);
    }
    public function passedit(){

      $bkurl = request()->redirect_url ?: '/';
      return view('mnovels.userpassedit',compact('bkurl'));
    }

    public function passupdate(Request $request)
    {
      $user = Auth::user();
      if (md5($request->pass)  !=  $user->pass) {
          $error = new MessageBag([
            'pass'   => '原始密码不对'
          ]);
          return
                  redirect()->back()
                            ->withErrors($error);
      }

      $this->validate($request, [
          'newpass'   => 'required|confirmed|min:6|max:16',
          'newpass_confirmation'           => 'required|min:6|max:16',
      ]);


      if ($request->pass  ==  $request->newpass) {
          $error = new MessageBag([
            'newpass'   => '原始密码与新密码不能相同'
          ]);
          return
                  redirect()->back()
                            ->withInput()
                            ->withErrors($error);
      }

      try {
          $user->pass = md5($request->newpass);
          $user->save();
          return redirect()->route('mnovels.user.show');
      } catch (\Exception $exception) {
          $error = new MessageBag([
            'pass'   => '修改密码失败'
          ]);
          return redirect()->back()->withErrors($error);
      }
    }

}
