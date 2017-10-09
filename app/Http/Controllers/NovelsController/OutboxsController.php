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



    public function create(Request $request)
    {
        $title = $request->title ?: '来源Web用户中心的问题';
        $from = $request->from;

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
