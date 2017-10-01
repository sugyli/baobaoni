<?php

namespace App\Http\Controllers\NovelsController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Auth;

//use App\Http\Controllers\Traits\PublicTrait;
class InboxsController extends Controller
{


    //use PublicTrait;
    //列出收件箱
    public function index()
    {
      $user = Auth::user();
      $limit = $user->getUserHonor()->getMassageMaxCount();
      $user->load(['relationInboxs' => function ($query) use ($limit){
          $query->where('todel','!=',1)
                ->orderBy('postdate', 'desc')
                ->limit($limit);
      }]);
      $user->markAdminemailAsRead();
      //$supplement = ['title'=>'收件箱' ,'subTitle'=>'发件人'];
      return view('webdashubao.userinbox' , compact('user'));

    }

    public function show($id)
    {

      $user = Auth::user();
      $messageData = $user->relationInboxs()
                    ->where('messageid', $id)
                    ->where('todel','!=',1)
                    ->first();

      if ($messageData) {
          $messageData->markAsRead();
          $user->markAdminemailAsRead();
          return view('webdashubao.usermessageshow', compact('messageData'));
      }

      session()->flash('message', '您没有此消息');
      return redirect()->route('inboxs.index');
    }

    public function destroy(Request $request)
    {
        $ids  =  $request->checkid;
        //批量删除
        if(is_array($ids) && count($ids)>0)
        {

          $backData =  Auth::user()->relationInboxs()
                      ->whereIn('messageid', $ids)
                      ->update(['todel' => 1]);
          if ($backData) {
            session()->flash('message', '批量删除成功');
            return redirect()->route('inboxs.index');
          }

        }elseif (!is_array($ids) && $ids > 0) {
          $backData =  Auth::user()->relationInboxs()
                      ->where('messageid', $ids)
                      ->update(['todel' => 1]);
          if ($backData) {
            session()->flash('message', '删除成功');
            return redirect()->route('inboxs.index');
          }
        }
        session()->flash('message', '删除失败');

        return redirect()->route('inboxs.index');

    }
}
