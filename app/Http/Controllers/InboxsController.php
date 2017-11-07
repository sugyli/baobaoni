<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Storage;
use Auth;

//use App\Http\Controllers\Traits\PublicTrait;
class InboxsController extends Controller
{
    //use PublicTrait;
    public function index(){
      $user = Auth::user();
      $limit = $user->getUserHonor()->getMassageMaxCount();
      $user->load(['relationInboxs' => function ($query) use ($limit){
          $query->where('todel','!=',1)
                ->orderBy('postdate', 'desc')
                ->limit($limit);
      }]);
      $user->markAdminemailAsRead();
      $bkurl = request()->redirect_url ?: '/';
      //$supplement = ['title'=>'收件箱' ,'subTitle'=>'发件人'];
      return view('userinbox' , compact('user','bkurl'));

    }


    public function destroy(Request $request)
    {
        $id  =  (int)($request->id + 0);
        if($id > 0){
          $backData =  Auth::user()->relationInboxs()
                      ->where('messageid', $id)
                      ->update(['todel' => 1]);
          if ($backData) {
            session()->flash('message', '删除成功');
            return redirect()->route('novel.inboxs.index');
          }


        }
        session()->flash('message', '删除失败');

        return redirect()->route('novel.inboxs.index');

    }


    public function show($id){
      $user = Auth::user();
      $messageData = $user->relationInboxs()
                    ->where('messageid', $id)
                    ->where('todel','!=',1)
                    ->first();

      if ($messageData) {
          $messageData->markAsRead();
          $user->markAdminemailAsRead();
          $bkurl = request()->redirect_url ?: '/';
          return view('usermessageshow', compact('messageData','bkurl'));
      }

      session()->flash('message', '您没有此消息');
      return redirect()->route('novel.inboxs.index');

    }


}
