<?php

namespace App\Http\Controllers\MNovels;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Article;
use App\Models\Chapter;
use Cache;
use App\Models\Ranking;
class NovelsController extends Controller
{


    public function __construct()
    {

    }
    /*
    public function search()
    {
        return view('mnovels.search');
    }


    public function getsearch()
    {
        $query = \Purifier::clean(request('query'), 'search_q');

        $result = ['error'=>1,'message'=>'未知错误','bakdata'=>[]];
        if(empty($query)){
          $result['message'] = '搜索关键词不能为空';
          return response()->json($result);
        }

        $datas =  Article::search($query, null, true)
                            ->getBasicsBook()
                            ->orderBy('lastupdate', 'desc')
                            ->remember(config('app.cacheTime_g'))
                            ->paginate(20);
        //分页支持这种
        if($datas->count() <= 0){
          $result['message'] = '没有搜索到内容';
          return response()->json($result);
        }

        $result['error'] = 0;
        $result['message'] = '获取成功';
        $result['bakdata'] = $datas;
        return response()->json($result);
    }
    */
    public function wapsort()
    {
        return view('mnovels.wapsort');
    }


    public function showwapsort()
    {
      $id = request()->id;
      if(!isset(config('app.fenlei')[$id-1])){
        $id = 1;
      }
      $sortname = config('app.fenlei')[$id-1];
      $bookDatas = Article::where('sortid',$id)
                            ->getBasicsBook()
                            ->orderBy('lastupdate', 'desc')
                            ->remember(config('app.cacheTime_d'))
                            ->paginate(20);

      return view('mnovels.wapsortlist' ,compact('sortname','bookDatas'));
    }



    public function waptop()
    {
        return view('mnovels.waptop');
    }

    public function showwaptop(Article $article)
    {

      $any = request()->any;
      $name = $article->getArticleFilterName($any);
      $bookDatas = $article->getArticlesWithFilter($any);
      if(str_contains($any , 'hit')){
        return view('mnovels.waptophitlist' ,compact('name','bookDatas'));
      }
      return view('mnovels.waptoplist' ,compact('name','bookDatas'));

    }


    public function info(Article $article)
    {

      $any = request()->any;
      $bid = request()->bid;
      if(!empty($any)){
          return redirect(route('mnovels.info', ['bid' => $bid]) , 301);
      }

      $bookData = $article->getBidBookData($bid);
      if($bookData){
          /*
          $slug = request()->slug;
          $any = request()->any;
          if ((!empty($bookData['slug']) && $bookData['slug'] != $slug) || !empty($any)) {
              return redirect($bookData['link'], 301);
          }
          */

          return view('mnovels.info', compact('bookData'));
      }
      return redirect('/');
    }


    public function index(){

      $article = app(Article::class);
      $newBookDatas = $article->getArticlesWithFilter('newbook',6);
      $daydates = $article->getArticlesWithFilter('dayhit',6);
      $weekdates = $article->getArticlesWithFilter('weekhit',6);
      $monthdates = $article->getArticlesWithFilter('monthhit',6);
      $updataBooks = $article->getArticlesWithFilter('updatebook',10);
      return view('mnovels.index',compact('newBookDatas','weekdates','monthdates','daydates','updataBooks'));
    }

    public function htmlmulu($bid)
    {
        $bid = (int)request()->bid + 0;
        $page = (int)request()->id + 0;
        $sort  = request()->zid ? 'desc' : null ; //false正序

        $bookData = app(Article::class)->getBidBookData($bid);
        if(!$bookData){
            return redirect('/');
        }
        $total = count($bookData['relation_chapters']);
        $infoUrl = route('mnovels.info', ['bid' => $bid]);
        if($total <= 0){

            return redirect($infoUrl);
        }
        $pageSize = (int)config('app.wapmululiebiao');
        //计算总页数
        $pagenum = (int)ceil($total / $pageSize);//当没有数据的时候 计算出来为0

        if ($page <= $pagenum && $page > 0)
        {
            //开始的索引
            $offset = ($page - 1) * $pageSize;
            if ($sort == 'desc') {
                //翻转
                $bookData['relation_chapters'] = collect($bookData['relation_chapters'])
                                                        ->reverse()
                                                        ->all();
            }
            $chapters = collect($bookData['relation_chapters'])->slice($offset, $pageSize)->values();
            $thispage = "";
            $pageset = '<div class="showpage r3"><div class="bk">请选择章节</div><ul>';
            //分页样式
            for($i = 1 ; $i <= $pagenum ; $i++){
                if($i == $page){
                    $thispage .= '<a class="xbk this tb">'.(($i-1)*$pageSize+1).' - '.($i*$pageSize).'章</a>';
                    $pageset .= $thispage;
                }
                else{
                    $url = empty($sort) ? route('mnovels.newmulu',['bid'=>$bid ,'id'=>$i]) : route('mnovels.newmulu1',['bid'=>$bid ,'id'=>$i ,'zid'=>1]);

                    $pageset .= '<li><a href=" ' . $url  . '" class="xbk">'.(($i-1)*$pageSize+1).' - '.($i*$pageSize).'章</a><li>';
                }
            }
            $pageset .= '<li><a class="xbk tb">没有更多分页了！</a></li></ul></div>'."<div id='spagebg'></div>";
            $pageset .= '<div class="spage" class="xbk r3">'.$thispage.'</div>'.$pageset;
            $title = $bookData['articlename'];
            $nextpage = $page +1;
            $pevpage = ($page-1) <= 0 ? 1 : ($page-1);

            if($page == $pagenum){
              return view('mnovels.newmulu',compact('pageset','chapters','bid','title' ,'pageset' ,'sort' ,'nextpage','pevpage','infoUrl'));
            }
            return response()
                    ->view('mnovels.newmulu',compact('pageset','chapters','bid','title' ,'pageset' ,'sort' ,'nextpage','pevpage','infoUrl'))
                    ->header('Cache-Control', 'private');
            //return view('mnovels.newmulu',compact('pageset','chapters','bid','title' ,'pageset' ,'sort' ,'nextpage','pevpage','infoUrl'));
        }

        $muluUrl = route('mnovels.newmulu', ['bid' => $bid ,'id'=>1]);
        return redirect($muluUrl);

    }
    //判断是否更新
    public function upsqldata()
    {
        $bid = (int)request()->bid + 0;
        if ($bid>0) {
            $key = 'getBidBookData_'.$bid;
            if (\Cache::has($key)) {

                $cCount = Chapter::getBasicsChapter()
                              ->where('articleid',$bid)
                              ->count();
                $bookData = Cache::get($key);
                if($cCount>0 && count($bookData['relation_chapters']) != $cCount){
                  Article::getBidBookDataByGet($bid);
                }
                unset($bookData);

            }else{
                Article::getBidBookDataByGet($bid);
            }
        }
        echo 'ok';
        //response('console.log("1");', 200);

    }


    public function mulu($bid)
    {
      return view('mnovels.mulu',compact('bid'));

    }

    public function getmulu(Article $article)
    {
        $bid = (int)request()->bid + 0;
        $page = (int)request()->page + 0;
        $bookData = $article->getBidBookData($bid);

        $result = ['error'=>1,'message'=>'未知错误','bakdata'=>[]];
        if(!$bookData){
          $result['message'] = "本书不存在";
          return response()->json($result);

        }
        $total = count($bookData['relation_chapters']);
        $pageSize = (int)config('app.wapmululiebiao');
        //计算总页数
        $pagenum = (int)ceil($total / $pageSize);//当没有数据的时候 计算出来为0
        if ($page<=0 || $page > $pagenum)
        {
          // $page = $pagenum;//分页越界
           $result['error'] = 3;
           $result['message'] = "总页数{$pagenum},请求页数{$page}";
           return response()->json($result);

        }
        //开始的索引
        $offset = ($page - 1) * $pageSize;
        $chapters = collect($bookData['relation_chapters'])->slice($offset, $pageSize)->values();
        $result['message'] = "请求第{$page}页数据成功";
        $result['error'] = 0;
        $result['bakdata'] =  $chapters;
        $result['bookName'] =  $bookData['articlename'];
        $result['lastpage'] = $pagenum;
        return response()->json($result);

    }

    public function content($bid , $cid)
    {
        $content  = config('app.dfnr');
        $infoUrl = route('mnovels.info', ['bid' => $bid]);
        $isimg = 0;//判断是否图片
        $bookData = app(Article::class)->getBidBookData($bid);

        if(!$bookData){
            return redirect('/');
        }
        $pKey;
        $chapter = collect($bookData['relation_chapters'])->first(function ($value, $key) use($cid , &$pKey){
                        if($value['chapterid'] == $cid){
                          $pKey = $key + 1;
                          return true;
                        }
                    });
        //$chapter = $bookData->relationChapters->where('chapterid', $cid)->first();
        if(!$chapter){
            return redirect($infoUrl);
        }

        $any = request()->any;
        if (!empty($any)) {
            return redirect($chapter['link'], 301);
        }
        //获取章节所在的分页数
        $pageSize = (int)config('app.wapmululiebiao');
        $page = (int)ceil($pKey/$pageSize);
        $weizhi = ((int)($pKey % $pageSize)) * 40 - 80;
        $weizhi = $weizhi < 0 ? 0 : $weizhi;

        //获取上下页对象 要以chapterorder排序获取
        $chapterorder = $chapter['chapterorder'];

        $previousChapter =
                          collect($bookData['relation_chapters'])->last(function ($item, $key) use($chapterorder) {
                                                return ($item['chapterorder'] < $chapterorder && $item['chaptertype'] <= 0);
                                          });
                                          //下一页
        $nextChapter  =
                          collect($bookData['relation_chapters'])->first(function ($item, $key) use($chapterorder) {
                                      return ($item['chapterorder'] > $chapterorder && $item['chaptertype'] <= 0);
                                  });

        //下面是获取TXT的部分
        $txtObj = saveOrGetTxtData($bid , $cid, $chapter['lastupdate'] ,$chapter['attachment']);
        if ($txtObj['state']) {
            //判断附件 如果替换了文字就不会走这个
            if (!empty($chapter['attachment']) && getstrlength($txtObj['content']) <= config('app.minnr')){
              $imgobj = unserialize($chapter['attachment']);
              $imghtml = '';
              foreach ($imgobj as  $item) {
                  $img = config('app.imagedir') . intval($bid/1000) .'/'.$bid ."/". $cid . "/" .$item['name'];
                  $imghtml .= '<div class="divimage"><img src="'. $img .'" /></div>';
              }
              $content = $imghtml;
              $isimg = 1;
            }else {
              //$content = contentReplace($txtObj['content']);
              $content = \Purifier::clean($txtObj['content'],'xiaoshuo_body');

            }

        }else{
            //防止有图片但是txt丢失的问题
            if (!empty($chapter['attachment'])){
                  $imgobj = unserialize($chapter['attachment']);
                  $imghtml = '';
                  foreach ($imgobj as  $item) {
                      $img = config('app.imagedir') . intval($bid/1000) .'/'.$bid ."/". $cid . "/" .$item['name'];
                      $imghtml .= '<div class="divimage"><img src="'. $img .'" /></div>';
                  }
                  $content = $imghtml;
                  $isimg = 1;
            }
        }
        return view('mnovels.reader', compact('chapter','previousChapter','nextChapter','content','isimg','page','weizhi'));


    }
    public function hislogs()
    {
        return view('mnovels.hislogs');
    }


}
