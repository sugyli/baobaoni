<?php

namespace App\Http\Controllers\MNovels;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Models\Article;
use App\Models\Chapter;
use App\Models\Bookcase;
class BookshelfsController extends Controller
{
    public function addbookcase(Request $request)
    {
        $user = $request->user();
        $result = ['error'=>1,'message'=>'未知错误','bakdata'=>[]];
        if (empty($user)) {
            $result['message'] = '您还没有登录,请登录！';
            return response()->json($result);
        }
        $bid = (int)$request->bid;
        $cid = (int)$request->cid;
        $time = time();
        if($bid <= 0){
          $result['message'] = '操作非法';
          return response()->json($result);
        }
        //用户拥有的书架
        $userBookshelfCount = (int)$user->getBookcaseCount();
        //已经使用的书架
        $userUseBookCount = (int)$user->relationBookcasesUse();
        if($userUseBookCount > $userBookshelfCount){
            $z = $userUseBookCount - $userBookshelfCount;
            $result['message'] = "您的书架已经越界 {$z} 本,请删除才能添加";
            return response()->json($result);
        }elseif ($userUseBookCount == $userBookshelfCount) {
          $result['message'] = "您的书架已经满了,不能添加了";
          return response()->json($result);
        }

        $article = Article::where('articleid', $bid)->getBasicsBook()->first();
        if (empty($article)) {
            $result['message'] = '本书已经不存在了';
            return response()->json($result);
        }

        if($cid > 0){
          $chapter = Chapter::where('display', '<=', '0')->find($cid);
          if (empty($article)) {
              $result['message'] = '本章节已经不存在了';
              return response()->json($result);
          }
        }

        $bookcase = $article->relationBookcases($user->uid);

        if (empty($bookcase)) {//看看这本书 用户书架有没有
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


    public function index(){
      $user = Auth::user();
      return view('mnovels.userbookshelf',compact('user'));

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
      $user = $request->user();
      $bid = $request->bid + 0;
      $cid = $request->cid + 0;
      if($user){

        if($bid > 0){
          $user->relationBookcases()
                       ->where('articleid', $bid)
                       ->update(['lastvisit' => time()]);
        }

      }

      if($cid > 0){
        return redirect()->route('mnovels.content',['bid'=>$bid , 'cid' =>$cid]);
      }

      return redirect()->route('mnovels.info',['bid'=>$bid]);
    }

    public function destroy(Request $request , Bookcase $bookcase)
    {
        $user = $request->user();
        $result = ['error'=>1,'message'=>'未知错误','bakdata'=>[]];
        if (empty($user)) {
          $result['message'] = '还没有登录';
          return response()->json($result);
        }
        //$arr = [];
        $caseid  =  (int)($request->caseid + 0);

        if ($caseid > 0) {
        //  array_push($arr,$caseid);
          $a =  $user->relationBookcases()
                       ->where('caseid', $caseid)
                       ->delete();
           if ($a) {
             $result['error'] = 0;
             $result['message'] = '删除成功';
             return response()->json($result);
           }
        }
        $result['message'] = '删除失败';
        return response()->json($result);

    }
}
