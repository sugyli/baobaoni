<?php
//缓存小说 和目录
if (!function_exists('saveOrGetBookData')) {
  function saveOrGetBookData($bid)
  {
    $key = config('app.bookid') . $bid;
    $bookObj = \Cache::get($key);
    if ( !$bookObj ) {//不存在
          $article = \App\Models\Article::find($bid);
          if (empty($article)) {
              dd('本书不存在');
          }
          if(empty($article->slug)){
            $article->slug =  \App\Libraries\SlugTranslate::translate($article->articlename);
            $article->save();
          }
          $article->load('relationChapters');
          \Cache::put($key, $article, get_sys_set('cacheTime_z'));
          return $article;
    }
    return $bookObj;
  }
}
/*

//保存的是对象
function saveOrGetBookInfoData($key , $value)
{

    $articleObj = \Cache::get($key);
    if ( !$articleObj ) {//不存在
          $articleObj =   app(\App\Models\Article::class)->getOneBookData($value)->first();

          if ($articleObj) {
            $articleObj->load('relationChapters');

          //  $articleObj = $articleObj->relationChapters('desc');

          //  \Cache::put($key, $articleObj, config('app.cacheTime_z'));
          }else{
            $value = (string) $value;
            \Log::error('本书不存在',['传值'=>$value]);
          }

    }
    return $articleObj;

    //注意上下2个存储 区别就是  下面会存空对象  上面不会


  return
          \Cache::remember($key, config('app.cacheTime_z'), function () use($value){

              $articleObj =   app(\App\Models\Article::class)->getOneBookData($value)->first();

              if (!$articleObj) {
                  $value = (string) $value;

                  \Log::error('本书不存在',['传值'=>$value]);
              }else{

                  return $articleObj;

              }

           });


}


function saveOrGetBookChapterData($key , \App\Models\Article $article)
{

      $chapterObj = \Cache::get($key);
      if ( !$chapterObj ) {//不存在
            $chapterObj =   $article->relationChapters()->get();

            if(!$chapterObj->isEmpty()){//取出来不为空
              \Cache::put($key, $chapterObj, config('app.cacheTime_z'));

              if($chapterObj->count() >= MAXCHAPTER) {
                \Log::warning('小说章节数量超过或等于设置' .MAXCHAPTER. '的数量 只列那么多' ,['书id'=>$article->articleid]);
              }

            }else{
              \Log::warning('没有获取到本书的章节',['书id'=>$article->articleid]);
            }

      }
      return $chapterObj;

  return
          \Cache::remember($key, config('app.cacheTime_z'), function () use($article){

              $chapterObj =  $article->relationChapters()->get();
              if($chapterObj->isEmpty()){

                \Log::warning('小说章节数量为0',['书id'=>$article->articleid]);

              }else{

                if($chapterObj->count() >= MAXCHAPTER) {
                  \Log::warning('小说章节数量超过或等于设置' .MAXCHAPTER. '的数量 只列那么多' ,['书id'=>$article->articleid]);
                }


                return $chapterObj;


              }

           });


}
*/

//获取小说内容
if (!function_exists('saveOrGetTxtData')) {
  function saveOrGetTxtData($key , $txtDir , $lastupdate ,$attachment)
  {
      $outData = ['state'=>false ,'content'=>''];
      $cacheDataArry = \Cache::get($key);
      if ( !$cacheDataArry ) {//不存在
          $outData = saveTxt($key,$txtDir,$lastupdate,$outData,$attachment);
      }elseif ($cacheDataArry && $lastupdate != $cacheDataArry['lastupdate']) {//虽然有缓存 但是内容被编辑过
          $outData = saveTxt($key,$txtDir,$lastupdate,$outData,$attachment);
      }elseif ($cacheDataArry) {
        $outData = $cacheDataArry;
      }

      return $outData;

  }
}

if (!function_exists('saveTxt')) {
  function saveTxt($key,$txtDir,$lastupdate,$outData ,$attachment)
  {
      $txt = curlTxt($txtDir,$attachment);
      if (!empty($txt)) {
        $outData = ['state'=>true , 'content'=>$txt , 'lastupdate' =>$lastupdate];
        \Cache::put($key, $outData, get_sys_set('cacheTime_g'));
      }

      return $outData;
  }
}

if (!function_exists('curlTxt')) {
  function curlTxt($txtDir,$attachment)
  {

      $txt = '';
      try {
        $curl = new \Curl\Curl();
        $curl->setOpt(CURLOPT_TIMEOUT, 5);
        $curl->get($txtDir);
        $curl->close();
        if ($curl->http_status_code == '200') {
            $txt = $curl->response;
            $txt = trim($txt);
            if (!empty($txt)) {
                $txt = mb_convert_encoding($txt, 'utf-8', 'GBK,UTF-8,ASCII');
            }else {
                txtLog($txtDir,$attachment,$curl->http_status_code);
            }

        }else{
            //记录获取错误的TXT 因为历史原因 可记录
            txtLog($txtDir,$attachment,$curl->http_status_code);

        }
        return $txt;


      } catch (Exception $e) {
        \Log::error('采集异常报错了',['路径'=>$txtDir]);

        return $txt;
      }

  }
}

if (!function_exists('txtLog')) {
  function txtLog($txtDir,$attachment,$http_status_code)
  {

    //记录获取错误的TXT 因为历史原因 可记录
    if (get_sys_set('txtlog')) {

        if (!empty($attachment)) {
          $ms = 'txt内容获取失败 有附件提示可能是图片 状态码不是200 代表txt文件不存在';
        }else{
          $ms = 'txt内容获取失败 状态码不是200 代表txt文件可能不存在';
        }

        \Log::info($ms,['路径'=>$txtDir ,'状态码'=>$http_status_code]);
    }

  }
}

if (!function_exists('getChapterUrl')) {
  function getChapterUrl($chapter , \App\Models\Article $article)
  {
      if ($chapter instanceof \App\Models\Chapter) {
          return $chapter->link();
      }

      return $article->link();

  }
}

if (!function_exists('qiandaoList')) {
  function qiandaoList()
  {
    return
            \Cache::remember('qiandao', get_sys_set('cacheTime_d'), function (){

                return \App\Models\Qiandao::orderBy('last_dateline', 'DESC')
                                    ->limit(30)
                                    ->get();

             });

  }
}

if (!function_exists('contentReplace')) {
  function contentReplace($txt)
  {

    $txt = preg_replace('/<br\\s*?\/??>/i',PHP_EOL,$txt);
    $txt = preg_replace('/<\/br\\s*?\/??>/i',PHP_EOL,$txt);
    $txt = preg_replace('/<p\\s*?\/??>/i',PHP_EOL,$txt);
    $txt = preg_replace('/<\/p>/i',PHP_EOL,$txt);
    $txt = @str_replace("&nbsp;"," ",$txt);

    return $txt;


  }
}


/**
 * 求取字符串位数（非字节），以UTF-8编码长度计算
 *
 * @param string $string 需要被计算位数的字符串
 * @return int
 * @author Seven Du <lovevipdsw@vip.qq.com>
 **/

if (!function_exists('getstrlength')) {
  function getstrlength($string)
  {
      $length = strlen($string);
      $index  = $num = 0;
      while ($index < $length) {
          $str = $string[$index];
          if ($str < "\xC0") {
              $index += 1;
          } elseif ($str < "\xE0") {
              $index += 2;
          } elseif ($str < "\xF0") {
              $index += 3;
          } elseif ($str < "\xF8") {
              $index += 4;
          } elseif ($str < "\xFC") {
              $index += 5;
          } else {
              $index += 6;
          }
          $num += 1;
      }
      return $num;
  }
}

if (!function_exists('formatTime')) {
  function formatTime($t)
  {
    $t = date("Y-m-d H:i:s",$t);  //24小时
    //dd($t);
    //date("Y-m-d h:i:s");  //12小时
    //$t =  date("Y-n-d h:i",$t);
    return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $t)->diffForHumans();
  }
}

//使用回调函数筛选集合，只留下那些通过判断测试的项目
if (!function_exists('getUserHonor')) {
  function getUserHonor(\App\Models\User $user){

      $honor = getHonor();
      if ($honor && $honor->count() >0) {

        $filtered = $honor->first(function ($item, $key) use($user){

          return ($user->score >= $item->minscore && $user->score < $item->maxscore);

        });
        return $filtered;
      }
      throw new \Exception('请设置用户等级');
  }
}
//获取头衔
if (!function_exists('getHonor')) {
  function getHonor(){
      $honor = \Cache::get(config('app.honors'));

      if ( !$honor ) {//不存在
          $honor = \App\Models\Honor::orderBy('maxscore', 'asc')->get();
          if ($honor->count() >0) {
            \Cache::forever(config('app.honors'), $honor);
          }

      }
      return $honor;
  }
}
//没有用到
if (!function_exists('get_image_links')) {
  function get_image_links($html)
  {
      $image_links = get_images_from_html($html);
      $result = [];
      foreach ($image_links as $url) {
          if (strpos($url, config('app.url_static' ,'')) !== false) {
              $result[] = strtok($url, '?');
          }
      }
      return $result;
  }
}

if (!function_exists('get_images_from_html')) {
  function get_images_from_html($html)
  {
      $doc = new DOMDocument();
      @$doc->loadHTML($html);

      $img_tags = $doc->getElementsByTagName('img');

      $result = [];
      foreach ($img_tags as $img) {
          $result[] = $img->getAttribute('src');
      }

      return $result;
  }
}

/**
 * t函数用于过滤标签，输出没有html的干净的文本
 * @param string text 文本内容
 * @return string 处理后内容
 */

if (!function_exists('t')) {
    function t($text)
    {
        $text = nl2br($text);
        $text = real_strip_tags($text);
        $text = addslashes($text);
        $text = trim($text);

        return $text;
    }
}
if (!function_exists('real_strip_tags')) {
    function real_strip_tags($str, $allowable_tags = '')
    {
        $str = html_entity_decode($str, ENT_QUOTES, 'UTF-8');

        return strip_tags($str, $allowable_tags);
    }
}


//分类
if (!function_exists('get_all_sorts')) {
    function get_all_sorts()
    {
      $sorts = \Cache::get(config('app.sorts'));
      if ( !$sorts ) {//不存在
          $sorts = \App\Models\Sort::where('is_hide','no')
                                  ->orderBy('parent_id', 'asc')
                                  ->orderBy('order', 'asc')
                                  ->get();
          if ($sorts->count() >0) {
            \Cache::forever(config('app.sorts'), $sorts);
          }

      }
      return $sorts;
    }
}

if (!function_exists('getMenuTree')) {

      function getMenuTree($arrCat,$parent_id = 0, $title='')
      {
          static  $arrTree = array(); //使用static代替global
          if(empty($arrCat)) return false;
          foreach($arrCat as $key => $value)
          {
            if (!empty($title)) {
              if($value['parent_id'] == $parent_id && $value['title'] == $title)
              {
                  //$value['level'] = $level;
                  //$arrTree[] = $value;
                  unset($arrCat[$key]); //注销当前节点数据，减少已无用的遍历
                  getMenuTree($arrCat, $value['id']);
              }
            }else{

              if($value['parent_id'] == $parent_id)
              {
                  //$value['level'] = $level;
                  $arrTree[] = $value;
                  unset($arrCat[$key]); //注销当前节点数据，减少已无用的遍历
                  getMenuTree($arrCat, $value['id']);
              }

            }
          }

          return $arrTree;
      }

}

if (!function_exists('get_sort')) {

      function get_sort($str)
      {
        $key = 'get_sort_'.$str;
        if (!\Cache::has(config('app.sorts'))) {

            \Cache::forget($key);

        }
        $sorts = \Cache::get($key);
        if ( !$sorts ) {//不存在
            $arrCat = get_all_sorts();
            if($arrCat->count()<=0) return false;
            $arrCat = $arrCat->toArray();
            $sorts = getMenuTree($arrCat, 0, $str);
            if (!empty($sorts)) {
              //\Cache::put($key, $sorts, config('app.cacheTime_g'));
              \Cache::forever($key, $sorts);
            }
        }
        return $sorts;

      }

}
if (!function_exists('select_sort')) {

      function select_sort()
      {
        $select_sort = [];
        $sorts = get_sort('webnovel');
        if(!empty($sorts)){
            foreach ($sorts as $key => $value) {
                $select_sort = $select_sort +   [$value['sortid'] => $value['title']];
            }

        }
        return $select_sort;

      }

}
if (!function_exists('del_hits_cache')) {

      function del_hits_cache($bid)
      {
        \Cache::forget(config('app.weekhits').$bid);
        \Cache::forget(config('app.monthhits').$bid);
        \Cache::forget(config('app.dayhits').$bid);

      }
}
//获取系统设置
if (!function_exists('get_sys_set')) {

      function get_sys_set($key)
      {
         $data = \Cache::get(config('app.syskey'));
         return  (isset($data[$key]) && !empty($data[$key])) ? $data[$key] : config('app.'.$key);

      }

}

?>
