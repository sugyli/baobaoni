<?php

namespace App\Http\Controllers\MNovels;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Article;
use Cache;
use App\Models\Ranking;
class NovelsController extends Controller
{


    public function __construct()
    {

    }
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

        $datas =  Article::search($query, null, true)->getBasicsBook()->orderBy('lastupdate', 'desc')->remember(config('app.cacheTime_d'))->paginate(10);
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
      $updataBooks = $article->getArticlesWithFilter('updatebook',6);
      return view('mnovels.index',compact('newBookDatas','weekdates','monthdates','daydates','updataBooks'));
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
    /*

    public function index(){

      if(\Agent::isMobile()){
        return $this->isMobileIndex();

      }
      return $this->isDesktopIndex();
    }
    protected function isMobileIndex()
    {

      $newBookDatas =
                    \Cache::remember('index_newbook', get_sys_set('cacheTime_d'), function (){

                        return $this->article->getArticlesWithFilter('newdata',6);

                     });
       $weekdates =
                     \Cache::remember('index_weekdate', get_sys_set('cacheTime_d'), function (){

                          return  Ranking::getWeekBookHits(31);

                      });

      $monthdates =
                    \Cache::remember('index_monthdate', get_sys_set('cacheTime_d'), function (){

                         return  Ranking::getMonthBookHits(31);

                     });

     $updataBooks = \Cache::remember('index_updatabook', get_sys_set('cacheTime_d'), function (){

                       return  $this->article->getArticlesWithFilter('updatedata',20);

                    });
      return view('wapdashubao.index', compact('newBookDatas','weekdates','monthdates','updataBooks'));

    }

    protected function isDesktopIndex()
    {

      $newBookDatas =
                    \Cache::remember('index_newbook', get_sys_set('cacheTime_d'), function (){

                        return $this->article->getArticlesWithFilter('newdata',6);

                     });
       $weekdates =
                     \Cache::remember('index_weekdate', get_sys_set('cacheTime_d'), function (){

                          return  Ranking::getWeekBookHits(31);

                      });
      $monthdates =
                    \Cache::remember('index_monthdate', get_sys_set('cacheTime_d'), function (){

                         return  Ranking::getMonthBookHits(31);

                     });

      $updataBooks = \Cache::remember('index_updatabook', get_sys_set('cacheTime_d'), function (){

                        return  $this->article->getArticlesWithFilter('updatedata',20);

                     });

      return view('webdashubao.index', compact('newBookDatas','weekdates','monthdates','updataBooks'));

    }

    public function show($bid){

      if(\Agent::isMobile()){

          return $this->isMobileShow($bid);
      }

      return $this->isDesktopShow($bid);
    }

    public function isDesktopShow($bid)
    {

        $bookData = Article::saveOrGetBookData($bid);
        if($bookData){
          $slug = request()->slug;
          $any = request()->any;
          if ((!empty($bookData->slug) && $bookData->slug != $slug) || !empty($any)) {
              return redirect($bookData->link(), 301);
          }

          //$sorts = $bookData->getSort();
          return view('webdashubao.info', compact('bookData'));

        }
        return redirect('/');

    }
    public function isMobileShow($bid)
    {
        $bookData = Article::saveOrGetBookData($bid);

        if($bookData){

          $slug = request()->slug;
          $any = request()->any;
          if ((!empty($bookData->slug) && $bookData->slug != $slug) || !empty($any)) {
              return redirect($bookData->link(), 301);
          }

          return view('wapdashubao.info',compact('bookData'));


        }

        return redirect('/');

    }


    public function showMulu($bid)
    {
      return view('wapdashubao.mulu',compact('bid'));

    }
    public function getMulu()
    {
        $bid = (int)request()->bid + 0;
        $page = (int)request()->page + 0;
        $bookData = Article::saveOrGetBookData($bid);
        $result = ['error'=>1,'message'=>'未知错误','bakdata'=>[]];
        if(!$bookData){
          $result['message'] = "本书不存在";
          return response()->json($result);

        }
        $total = $bookData->relationChapters->count();
        $pageSize = (int)get_sys_set('wapmululiebiao');
        //计算总页数
        $pagenum = (int)ceil($total / $pageSize);//当没有数据的时候 计算出来为0
        if ($page<=0 || $page > $pagenum)
        {
           // $page = $pagenum;//分页越界
            $result['message'] = "总页数{$pagenum},请求页数{$page}";
            return response()->json($result);
        }
        //开始的索引
        $offset = ($page - 1) * $pageSize;

        $chapters =  $bookData->relationChapters->reject(function ($value, $key) {
                                                return $value->chaptertype >0;
                                            })->slice($offset, $pageSize)->values();
        $result['message'] = "请求第{$page}页数据成功";
        $result['error'] = 0;
        $result['bakdata'] =  $chapters;
        $result['bookName'] =  $bookData->articlename;
        return response()->json($result);

    }


    public function showContent($bid , $cid){

      if(\Agent::isMobile()){

          return $this->isMobileShowContent($bid , $cid);
      }

      return $this->isDesktopShowContent($bid , $cid);
    }

    public function isMobileShowContent($bid , $cid)
    {
        $content  = get_sys_set('dfnr');
        $bakUrl = route('web.articles.show', ['bid' => $bid]);
        $isimg = 0;//判断是否图片
        $bookData = Article::saveOrGetBookData($bid);

        if(!$bookData){

            return redirect('/');
        }
        $pKey;
        $chapter = $bookData->relationChapters->first(function ($value, $key) use($cid , &$pKey){
            if($value->chapterid == $cid){
              $pKey = $key + 1;
              return true;
            }
        });
        //$chapter = $bookData->relationChapters->where('chapterid', $cid)->first();

        if ($chapter) {
            $any = request()->any;
            if (!empty($any)) {

                return redirect($chapter->link(), 301);
            }
            //获取章节所在的分页数
            $pageSize = (int)get_sys_set('wapmululiebiao');
            $page = (int)ceil($pKey/$pageSize);

            $weizhi = ((int)($pKey % $pageSize)) * 40 - 80;
            $weizhi = $weizhi < 0 ? 0 : $weizhi;
            //获取上下页对象 要以chapterorder排序获取
            $chapterorder = $chapter->chapterorder;
            //不存在返回NULL
            $previousChapter = $bookData->relationChapters->last(function ($item, $key) use($chapterorder) {
                                            return ($item->chapterorder < $chapterorder && $item->chaptertype <= 0);
                                      });

            //下一页
            $nextChapter  =    $bookData->relationChapters->first(function ($item, $key) use($chapterorder) {
                                            return ($item->chapterorder > $chapterorder && $item->chaptertype <= 0);
                                      });


            //下面是获取TXT的部分
            $path = intval($bid/1000) . '/' .$bid . "/{$cid}.txt";
            $txtDir = get_sys_set('txtdir') . $path;
            $keyTxt = config('app.txt') . $path;

            $txtObj = saveOrGetTxtData($keyTxt , $txtDir, $chapter->lastupdate ,$chapter->attachment);


            //获取到了内容 $txtObj['state'] == true 百分百有内容
            if ($txtObj['state']) {
                //判断附件 如果替换了文字就不会走这个
                if (!empty($chapter->attachment) && getstrlength($txtObj['content']) <= get_sys_set('minnr')){
                  $imgobj = unserialize($chapter->attachment);
                  $imghtml = '';
                  foreach ($imgobj as  $item) {
                      $img = get_sys_set('imagedir') . intval($bid/1000) .'/'.$bid ."/". $cid . "/" .$item['name'];
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
              if (!empty($chapter->attachment)){
                    $imgobj = unserialize($chapter->attachment);
                    $imghtml = '';
                    foreach ($imgobj as  $item) {
                        $img = get_sys_set('imagedir') . intval($bid/1000) .'/'.$bid ."/". $cid . "/" .$item['name'];
                        $imghtml .= '<div class="divimage"><img src="'. $img .'" /></div>';
                    }
                    $content = $imghtml;
                    $isimg = 1;
              }


            }
            return view('wapdashubao.reader', compact('chapter','previousChapter','nextChapter','content','isimg' ,'bookData','page','weizhi'));

        }

        return view('wapdashubao.reader');


    }

    public function isDesktopShowContent($bid , $cid)
    {
        //注释  过滤只在 内容获取到的时候
        //内容不存在默认提示语句
        $content  = get_sys_set('dfnr');
        $bakUrl = route('web.articles.show', ['bid' => $bid]);
        $isimg = 0;//判断是否图片
        //先要获取 章节 这个KEY 是获取章节的KEY
        //  $keyChapter = BIDCID_ . $article->articleid;
        //$chapters = saveOrGetBookChapterData($keyChapter , $article);
        //在章节列表查这个内容是否存在
        $bookData = Article::saveOrGetBookData($bid);

        if(!$bookData){

            return redirect('/');
        }

        //获取分类
        $sorts = $bookData->getSort();
        $chapter = $bookData->relationChapters->where('chapterid', $cid)->first();

        //$chapter = $chapters->where('chapterid', $cid)->first();

        if ($chapter) {
            $any = request()->any;
            if (!empty($any)) {
                return redirect($chapter->link(), 301);
            }

            //获取上下页对象 要以chapterorder排序获取
            $chapterorder = $chapter->chapterorder;
            //不存在返回NULL
            $previousChapter = $bookData->relationChapters->last(function ($item, $key) use($chapterorder) {
                                            return ($item->chapterorder < $chapterorder && $item->chaptertype <= 0);
                                      });

            //下一页
            $nextChapter  =    $bookData->relationChapters->first(function ($item, $key) use($chapterorder) {

                                            return ($item->chapterorder > $chapterorder && $item->chaptertype <= 0);
                                      });


            //下面是获取TXT的部分
            $path = intval($bid/1000) . '/' .$bid . "/{$cid}.txt";
            $txtDir = get_sys_set('txtdir') . $path;
            $keyTxt = config('app.txt') . $path;

            $txtObj = saveOrGetTxtData($keyTxt , $txtDir, $chapter->lastupdate ,$chapter->attachment);
            //获取到了内容 $txtObj['state'] == true 百分百有内容
            if ($txtObj['state']) {
                //判断附件 如果替换了文字就不会走这个
                if (!empty($chapter->attachment) && getstrlength($txtObj['content']) <= get_sys_set('minnr')){
                  $imgobj = unserialize($chapter->attachment);
                  $imghtml = '';
                  foreach ($imgobj as  $item) {
                      $img = get_sys_set('imagedir') . intval($bid/1000) .'/'.$bid ."/". $cid . "/" .$item['name'];
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
              if (!empty($chapter->attachment)){
                    $imgobj = unserialize($chapter->attachment);
                    $imghtml = '';
                    foreach ($imgobj as  $item) {
                        $img = get_sys_set('imagedir') . intval($bid/1000) .'/'.$bid ."/". $cid . "/" .$item['name'];
                        $imghtml .= '<div class="divimage"><img src="'. $img .'" /></div>';
                    }
                    $content = $imghtml;
                    $isimg = 1;
              }


            }
            //dd($previousChapter);
            //'article','chapter','previousChapter','nextChapter','content'  只有内容是字符串 其他都是对象 isimg 还没用到
            return view('webdashubao.content', compact('sorts','chapter','previousChapter','nextChapter','content','isimg' ,'bookData'));


        }

        return redirect($bakUrl, 301);


    }

    public function showfenlei()
    {
      $fenleidatas = $this->article->getArticlesWithFilter('fenleidata',12);
      if($fenleidatas->count() > 0){
        $sorts = $this->article->getSort(request()->id);
        return view('webdashubao.fenlei', compact('fenleidatas','sorts'));
      }
      return redirect('/');
    }

    */

}