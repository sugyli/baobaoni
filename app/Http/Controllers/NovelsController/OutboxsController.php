<?php

namespace App\Http\Controllers\NovelsController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Http\Requests\OutboxRequest;
use App\Http\Controllers\Traits\UsersTrait;
class OutboxsController extends Controller
{
    use UsersTrait;
    public function index()
    {
      $user = Auth::user();
      $limit = $user->getUserHonor()->getMassageMaxCount();
      $user->load(['relationOutboxs' => function ($query) use ($limit){
          $query->where('fromdel','!=',1)
                ->orderBy('postdate', 'desc')
                ->limit($limit);
      }]);
      //$supplement = ['title'=>'收件箱' ,'subTitle'=>'发件人'];
      return view('webdashubao.useroutbox' , compact('user'));

    }

    public function show($id)
    {
      $messageData = Auth::user()->relationOutboxs()
                                  ->where('messageid', $id)
                                  ->where('fromdel','!=',1)
                                  ->first();

      if ($messageData) {
          return view('webdashubao.usermessageshow', compact('messageData'));
      }

      session()->flash('message', '您没有此消息');
      return redirect()->route('member.outboxs.index');
    }

    public function create(Request $request){
      if(\Agent::isMobile()){

          return $this->isMobileCreate($request);
      }

      return $this->isDesktopCreate($request);
    }

    public function isMobileCreate(Request $request)
    {
        $title = $request->title ?: '来源Wap用户中心的问题';
        $from = $request->from ?: '来源不详';

        return view('wapdashubao.jubao',compact('title','from'));
    }

    public function isDesktopCreate(Request $request)
    {
        $title = $request->title ?: '来源Web用户中心的问题';
        $from = $request->from ?: '来源不详';

        return view('webdashubao.usermessagecreate',compact('title','from'));
    }


    public function store(OutboxRequest $request)
    {
        //$data = $request->only(['title','content']);
        if ($this->isDuplicateMessage($request->content)) {
            return $this->creatorFailed('请不要发布重复内容。');
        }
        $from = $request->from;
        if($from){
          $title = $request->title ."_来路：" . $from;
        }

        $user = Auth::user();
        $data['postdate'] = time();
        $data['fromname'] = $user->uname;
        $data['content'] = $request->content;
        $data['title'] = $title;
        $data['toid'] = 0 ;
        $data['toname'] = '';

        $message =  $user->relationOutboxs()
                          ->create($data);
        if (!$message) {
            return $this->creatorFailed('数据库繁忙稍后再试！');
        }
        $message->collectImages();
        session()->flash('message', '发送消息成功');
        return redirect()->route('member.outboxs.index');
    }

    public function mStore(Request $request)
    {
        $user = $request->user();
        $result = ['error'=>1,'message'=>'未知错误','bakdata'=>[]];

        if (empty($user)) {
            $result['message'] = '还没有登录';
            return response()->json($result);
        }

        $content =trim($request->content);
        $title = trim($request->title);
        $from = trim($request->from);
        if(empty($content) || empty($title)){
            $result['message'] = '内容、标题有一项为空了';
            return response()->json($result);
        }
        if ($this->isDuplicateMessage($content)) {
            $result['message'] = '请不要发布重复内容。';
            return response()->json($result);
        }

        if($from){
            $title = $title ."_来路：" . $from;
        }

        $user = Auth::user();
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


    public function destroy(Request $request)
    {
        $ids  =  $request->checkid;
        //批量删除
        if(is_array($ids) && count($ids)>0)
        {
          $backData =  Auth::user()->relationOutboxs()
                      ->whereIn('messageid', $ids)
                      ->update(['fromdel' => 1]);
          if ($backData) {
            session()->flash('message', '批量删除成功');
            return redirect()->route('member.outboxs.index');
          }

        }elseif (!is_array($ids) && $ids > 0) {
          $backData =  Auth::user()->relationOutboxs()
                      ->where('messageid', $ids)
                      ->update(['fromdel' => 1]);
          if ($backData) {
            session()->flash('message', '删除成功');
            return redirect()->route('member.outboxs.index');
          }
        }
        session()->flash('message', '删除失败');

        return redirect()->route('member.outboxs.index');

    }
}
