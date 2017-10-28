<?php

namespace App\Http\Controllers\NovelsController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Models\Bookcase;
use App\Models\Article;
use App\Models\Chapter;
class BookshelfsController extends Controller
{

    public function index(){

      if(\Agent::isMobile()){

          return $this->isMobileIndex();
      }

      return $this->isDesktopIndex();
    }
    public function isMobileIndex()
    {

       $user = Auth::user();
       $bkurl = request()->redirect_url ?: '/';
       return view('wapdashubao.userbookshelf',compact('user','bkurl'));
    }

    public function isDesktopIndex()
    {

       $user = Auth::user();
       return view('webdashubao.userbookshelf',compact('user'));
    }

    public function getBookshelfsData()
    {
       $user = Auth::user();
       $result = ['error'=>1,'message'=>'未知错误','bakdata'=>[]];

       if(empty($user)){
         $result['message'] = '还没有登录';
         return response()->json($result);
       }

       $bookcases = $user->relationBookcases()
                         ->with('relationArticles')->get();

       if (!$bookcases->isEmpty()) {
           $bookcases = $bookcases->sortByDesc('relationArticles.lastupdate');
           $bookcases = $bookcases->values();
           $result['error'] = 0;
           $result['message'] = "请求成功";
           $result['bakdata'] = $bookcases;
           //return $bookcases->toJson();
           return response()->json($result);
       }
       $result['message'] = '没有书架数据请添加';

       return response()->json($result);


    }


    public function clickBookshelf(Request $request)
    {
      $bid = $request->bid + 0;
      $cid = $request->cid + 0;
      //echo route('articles.show',['article'=>$bid , 'cid' =>$cid]);
      //return;
      if($bid > 0){
        Auth::user()->relationBookcases()
                     ->where('articleid', $bid)
                     ->update(['lastvisit' => time()]);
      }
      if($cid > 0){
        return redirect()->route('web.articles.content',['article'=>$bid , 'cid' =>$cid]);
      }

      return redirect()->route('web.articles.show',['article'=>$bid]);
    }


    public function destroy(Request $request , Bookcase $bookcase)
    {
        $user = Auth::user();
        if ($request->isMethod('post')) {
            $ids  =  $request->checkid;
            if (is_array($ids) && !empty($ids)) {
              $a =  $user->relationBookcases()
                           ->whereIn('caseid', $ids)
                           ->delete();
              if ($a) {
                session()->flash('message', '批量删除书架成功');
                return redirect()->route('member.bookshelf.index');
              }

            }
        }

        if ($request->isMethod('get')) {

            $id = $request->id;
            if ($id > 0) {
              $a =   $user->relationBookcases()
                          ->where('caseid', $id)
                          ->delete();

                if($a){
                  if($request->ajax()){

                     return response()->json(['error'=>0,'message'=>'删除成功']);

                  }else{

                    session()->flash('message', '删除单本书架成功');
                    return redirect()->route('member.bookshelf.index');

                  }


                }

            }

        }
        if($request->ajax()){
          return response()->json(['error'=>1,'message'=>'删除失败']);
        }
        session()->flash('message', '删除书架失败');
        return redirect()->route('member.bookshelf.index');

    }


    public function addbookcase(Request $request)
    {
        $user = $request->user();
        $result = ['error'=>1,'message'=>'未知错误','bakdata'=>[]];
        if (empty($user)) {
            $result['message'] = '您还没有登录,请登录！';
            return response()->json($result);
        }
        $bid = $request->bid + 0;
        $cid = $request->cid + 0;
        $time = time();
        if($bid <= 0){
          $result['message'] = '操作非法';
          return response()->json($result);
        }

        $article = Article::where('articleid', $bid)->first();
        if (empty($article)) {
            $result['message'] = '本书已经不存在了';
            return response()->json($result);
        }

        if($cid > 0){
          $chapter = Chapter::find($cid);
          if (empty($article)) {
              $result['message'] = '本章节已经不存在了';
              return response()->json($result);
          }
        }

        $bookcase = $article->relationBookcases($user->uid);
        if (empty($bookcase)) {//看看这本书 用户书架有没有
            $honor = $user->getUserHonor();
            $userBookshelfCount = $honor->getBookcaseCount();
            $userHaveBookCount = $user->relationBookcases->count();
            if($userHaveBookCount > $userBookshelfCount){
              $z = $userHaveBookCount - $userBookshelfCount;
              $result['message'] = "您的书架已经越界 {$z} 本,请删除才能添加";
              return response()->json($result);

            }elseif ($userHaveBookCount == $userBookshelfCount) {
              $result['message'] = "您的书架已经满了,不能添加了";
              return response()->json($result);
            }

            $data=[
                  'articleid' => $article->articleid,
                  'articlename' => $article->articlename,
                  'userid' => $user->uid,
                  'username' => $user->uname,
                  'classid' => 0,
                  'chapterid'=> 0,
                  'chaptername' => '',
                  'chapterorder' => 0,
                  'joindate' => $time,
                  'lastvisit' => $time,
                  'flag' => 0,
              ];

            $result['message'] = '添加书架成功了';
            if ($cid > 0) {
                $data['chapterid'] = $cid;
                $data['chaptername'] = $chapter->chaptername;
                $data['chapterorder'] = $chapter->chapterorder;
                $result['message'] = '添加书签成功了';
            }


            if(Bookcase::create($data)){
              $result['error'] = 0;
              return response()->json($result);
            }
            $result['message'] = '添加书架失败了';
            return response()->json($result);

        }

        if($cid<=0){
          $result['message'] = '本书已经在书架了,无需操作';
          return response()->json($result);
        }
        if (
          $bookcase->chapterid == $chapter->chapterid &&
          $bookcase->chaptername == $chapter->chaptername &&
          $bookcase->chapterorder == $chapter->chapterorder

        ) {
          $result['message'] = '章节已经在书架了,无需操作';
          return response()->json($result);
        }

        $bookcase->chapterid = $chapter->chapterid;
        $bookcase->chaptername = $chapter->chaptername;
        $bookcase->chapterorder = $chapter->chapterorder;
        if($bookcase->save()){
          $result['error'] = 0;
          $result['message'] = '更新书签成功了';
          return response()->json($result);
        }
        $result['message'] = '更新书签失败了';
        return response()->json($result);

    }
}
