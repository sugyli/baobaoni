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

        $num = $request->num + 0 ;
        $articleid = $request->bid + 0 ;
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
          $result['message'] = "不好意思您今日的推荐票只有 {$userRecommendCount} 张";
          return response()->json($result);

        }

        $date = date("Y-m-d",time());
        $date = strtotime($date);
        $ranking= $article->relationRankings($user->uid,$date);
        if(empty($ranking)){
            $data = [
              'articleid' => $articleid,
              'ranking_date' => $date,
              'hits' => $num,
            ];
            $bak = $user->relationRankings()->create($data);

            if($bak){
              $user->increment('score' , $num);
              $result['error'] = 0;
              $result['message'] = "推荐成功,并且获取 {$num} 点经验";
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
        if (($ranking->hits + $num) > $userRecommendCount) {
            $result['message'] = "不好意思您今日的推荐票不够了还剩余 {$nb} 张";
            return response()->json($result);
        }

        $ranking->increment('hits' , $num);
        $user->increment('score' , $num);
        $result['error'] = 0;
        $result['message'] = "推荐本书成功！并且获取 {$num} 点经验";
        del_hits_cache($articleid);
        return response()->json($result);


    }

    //用户首页
    public function show()
    {
      $user = Auth::user();
      $allHonors = getHonor();
      return view('webdashubao.usershow',compact('user','allHonors'));
    }

    public function edit()
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
            return redirect()->route('member.show');
        } catch (\Exception $exception) {
            session()->flash('message', '修改失败');
            return redirect()->back()->withInput();
        }

    }

    public function passedit()
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
          return redirect()->route('member.show');
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
