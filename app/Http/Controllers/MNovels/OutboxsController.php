<?php

namespace App\Http\Controllers\MNovels;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
//use App\Http\Requests\OutboxRequest;
use App\Http\Controllers\Traits\UsersTrait;
class OutboxsController extends Controller
{
    use UsersTrait;

    public function ajaxstore(Request $request)
    {
        $user = $request->user();
        $result = ['error'=>1,'message'=>'未知错误','bakdata'=>[]];

        if (empty($user)) {
            $result['message'] = '还没有登录';
            return response()->json($result);
        }

        $content =trim($request->content);
        $title = trim($request->title);
        if(empty($content) || empty($title)){
            $result['message'] = '内容、标题有一项为空了';
            return response()->json($result);
        }
        if ($this->isDuplicateMessage($content)) {
            $result['message'] = '请不要发布重复内容。';
            return response()->json($result);
        }

        $data['postdate'] = time();
        $data['fromname'] = $user->uname;
        $data['content'] = $content;
        $data['title'] = $title;
        $data['toid'] = 0 ;
        $data['toname'] = '';
        $message =  $user->relationOutboxs()
                          ->create($data);
        if (!$message) {
            $result['message'] = '数据库繁忙稍后再试！';
            return response()->json($result);
        }

        $result['message'] = '举报成功,回复请到邮箱查看';
        $result['error'] = 0;
        return response()->json($result);
    }

    public function index()
    {
      $user = Auth::user();
      $limit = $user->getMassageMaxCount();
      $user->load(['relationOutboxs' => function ($query) use ($limit){
          $query->where('fromdel','!=',1)
                ->orderBy('postdate', 'desc')
                ->limit($limit);
      }]);
      $bkurl = request()->redirect_url ?: route('mnovels.user.show');
      //$supplement = ['title'=>'收件箱' ,'subTitle'=>'发件人'];
      return view('mnovels.useroutbox' , compact('user','bkurl'));

    }

    public function show($id)
    {
      $messageData = Auth::user()->relationOutboxs()
                                  ->where('messageid', $id)
                                  ->where('fromdel','!=',1)
                                  ->first();

      if ($messageData) {
          //$bkurl = request()->redirect_url ?: '/';
          return view('mnovels.usermessageshow', compact('messageData'));
      }

      session()->flash('message', '您没有此消息');
      return redirect()->route('mnovels.outboxs.index');


    }

    public function destroy(Request $request)
    {

        $id  =  (int)($request->id + 0);
        if($id > 0){
          $backData =  Auth::user()->relationOutboxs()
                      ->where('messageid', $id)
                      ->update(['fromdel' => 1]);
          if ($backData) {
            session()->flash('message', '删除成功');
            return redirect()->route('mnovels.outboxs.index');
          }

        }

        session()->flash('message', '删除失败');

        return redirect()->route('mnovels.outboxs.index');

    }

}
