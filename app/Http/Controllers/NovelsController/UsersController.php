<?php

namespace App\Http\Controllers\NovelsController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Models\User;
use App\Models\Honor;
use App\Models\Message;
use App\Models\Article;
use Illuminate\Support\MessageBag;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Controllers\Traits\UsersTrait;
use Illuminate\Support\Facades\Storage;
class UsersController extends Controller
{
    use UsersTrait;
    public function __construct()
    {


      /*
        $this->middleware('auth', [
            'except' => ['getUser']
        ]);
      */
    }

    public function getuser(Request $request)
    {
        $user = $request->user();
        $result = ['error'=>1,'message'=>'未知错误','bakdata'=>[]];

        if (empty($user)) {
          $result['message'] = '还没有登录';
          return response()->json($result);
        }
        $result['error'] = 0;
        $result['message'] = '获取成功';
        $result['bakdata'] = $user;
        return response()->json($result);
    }

    public function recommend(Request $request)
    {
        $user = $request->user();
        $result = ['error'=>1,'message'=>'未知错误','bakdata'=>[]];
        if (empty($user)) {
          $result['message'] = '还没有登录';
          return response()->json($result);
        }

        $num = (int)$request->num + 0 ;
        $articleid = (int)$request->bid + 0 ;
        if ($num <= 0 || $articleid<=0) {
          $result['message'] = '操作非法';
          return response()->json($result);
        }
        $article  = Article::find($articleid);
        if (empty($article)) {
          $result['message'] = '本书已经不存在了';
          return response()->json($result);
        }

        $honor = $user->getUserHonor();
        $userRecommendCount = $honor->getDayRecommendCount();

        if($num > $userRecommendCount){
          $result['message'] = "不好意思您今日的推荐票一共只有 {$userRecommendCount} 张";
          return response()->json($result);
        }

        $date = date("Y-m-d",time());
        $date = strtotime($date);
        $s = get_sys_set('recommendscore');//增长的经验
        $s = $s * $num;
        $ranking= $article->relationRankings($user->uid,$date);
        if(empty($ranking)){
            $data = [
              'articleid' => $articleid,
              'ranking_date' => $date,
              'hits' => $num,
            ];
            $bak = $user->relationRankings()->create($data);

            if($bak){
              $sheng = $userRecommendCount - $num;
              $user->increment('score' , $s);
              $result['error'] = 0;
              $result['message'] = "今日首推荐成功,获取 {$s} 点经验 剩余 {$sheng} 票";
              del_hits_cache($articleid);
              return response()->json($result);
            }
            $result['message'] = '推荐出错了';
            return response()->json($result);
        }
        if($ranking->hits >=  $userRecommendCount){
          $result['message'] = '不好意思您今日的推荐票已经用完';
          return response()->json($result);
        }
        $nb = $userRecommendCount - $ranking->hits;
        $zen = $ranking->hits + $num;
        if ($zen > $userRecommendCount) {
            $result['message'] = "不好意思您今日的推荐票不够了还剩余 {$nb} 张";
            return response()->json($result);
        }

        $ranking->increment('hits' , $num);
        $sheng = $userRecommendCount - $zen;
        $user->increment('score' , $s);
        $result['error'] = 0;
        $result['message'] = "推荐成功！获取 {$s} 点经验 剩余 {$sheng} 票";

        del_hits_cache($articleid);
        return response()->json($result);
    }

    public function show(){

      if(\Agent::isMobile()){

          return $this->isMobileShow();
      }

      return $this->isDesktopShow();
    }
    public function isMobileShow()
    {
      $user = Auth::user();
      $bkurl = request()->redirect_url ?: '/';
      return view('wapdashubao.usershow',compact('user','bkurl'));
    }
    //用户首页
    public function isDesktopShow()
    {
      $user = Auth::user();
      $allHonors = getHonor();
      return view('webdashubao.usershow',compact('user','allHonors'));
    }

    public function edit(){

      if(\Agent::isMobile()){

          return $this->isMobileEdit();
      }

      return $this->isDesktopEdit();
    }

    public function isMobileEdit()
    {
      $user = Auth::user();
      $bkurl = request()->redirect_url ?: '/';
      return view('wapdashubao.useredit',compact('user','bkurl'));
    }

    public function isDesktopEdit()
    {
      $user = Auth::user();
      return view('webdashubao.useredit',compact('user'));
    }

    public function update(Request $request)
    {

        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|max:30',
            'mobile' => 'required|zh_mobile|unique:jieqi_system_users,mobile,'.$user->uid .',uid',
        ]);
        try {
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->save();
            session()->flash('message', '修改资料成功');
            return redirect()->route('member.user.show');
        } catch (\Exception $exception) {
            session()->flash('message', '修改失败');
            return redirect()->back()->withInput();
        }

    }

    public function passedit(){

      if(\Agent::isMobile()){

          return $this->isMobilePassedit();
      }

      return $this->isDesktopPassedit();
    }

    public function isMobilePassedit()
    {
      $bkurl = request()->redirect_url ?: '/';
      return view('wapdashubao.userpassedit',compact('bkurl'));
    }


    public function isDesktopPassedit()
    {
      return view('webdashubao.userpassedit');
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
          session()->flash('message', '修改密码成功');
          return redirect()->route('member.user.show');
      } catch (\Exception $exception) {
          session()->flash('message', '修改失败');
          return redirect()->back();
      }
    }



    public function imageUpload(Request $request)
    {
        if ($file = $request->file('imageFile')) {
            try {
                $user = Auth::user();
                $ImageUploadHandler = app('App\Libraries\ImageUploadHandler');
                $upload_status = $ImageUploadHandler->uploadImage($file ,'user_' . $user->uid);
                $ImageUploadHandler->saveTrash($upload_status , $user->uid , 'App\Models\User');
            } catch (\Exception $exception) {

                return response()->json(['errno' => $exception->getMessage()]);

            }
            /*

            //判断是不是从后台来的
            if($request->input('from')){
              return response($upload_status, 200)
                          ->header('Content-Type', 'text/plain');
            }
            */
            return response()->json(['errno' => 0, 'data' => [$upload_status]]);

        }

        return response()->json(['errno' => 'Error while uploading file']);

    }

    public function updateAvatar(Request $request)
    {
      //  dd($request->all());
        if ($file = $request->file('img')) {
            try {
                $user = Auth::user();
                $ImageUploadHandler = app('App\Libraries\ImageUploadHandler');
                $upload_status = $ImageUploadHandler->uploadAvatar($file,'user_' . $user->uid);
                $ImageUploadHandler->saveTrash($upload_status , $user->uid , 'App\Models\User');
                $user->savePortrait($upload_status);
            } catch (\Exception $exception) {

                return response()->json(['errno' => $exception->getMessage()]);

            }

            return response()->json(['errno' => 0, 'data' => $upload_status]);

        }

        return response()->json(['errno' => 'Error while uploading file']);
    }
}
