<?php
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
//获取小说内容
if (!function_exists('saveOrGetTxtData')) {

  function saveOrGetTxtData($bid,$cid,$lastupdate,$attachment)
  {
      $outData = ['state'=>false ,'content'=>''];

      if (!config('app.benditxt')) {
          $path = intval($bid/1000) . '/' .$bid . "/{$cid}.txt";
          $txtDir = config('app.txtdir') . $path;
          $key = 'txt_' . $path;
          $cacheDataArry = \Cache::get($key);
          if ( !$cacheDataArry ) {//不存在
              $outData = saveTxt($key,$txtDir,$lastupdate,$outData,$attachment);
          }elseif ($cacheDataArry && $lastupdate != $cacheDataArry['lastupdate']) {//虽然有缓存 但是内容被编辑过
              $outData = saveTxt($key,$txtDir,$lastupdate,$outData,$attachment);
          }elseif ($cacheDataArry) {
              $outData['state'] = true;
              $outData = $cacheDataArry;
          }


      }else{
          $path = "\\" .intval($bid/1000) . "\\" .$bid . "\\{$cid}.txt";
          $txtDir = config('app.benditxtdir') . $path;
          if(file_exists($txtDir)){
             $txtData = file_get_contents($txtDir);
             $txtData = trim($txtData);
             if (!empty($txtData)) {
                 $txtData = mb_convert_encoding($txtData, 'utf-8', 'GBK,UTF-8,ASCII');
                 $outData['state'] = true;
                 $txtData = @str_replace("\n\n","\n",$txtData);
                 $txtData = @str_replace("\n","\n\n",$txtData);
                 $txtData = @str_replace("&nbsp;"," ",$txtData);
                 $txtData = @str_replace("<","&lt;",$txtData);
                 $txtData = @str_replace(">","&gt;",$txtData);
                 $outData['content'] = $txtData;
             }

          }else{
            \Log::info('文件不存在',['路径'=>$txtDir]);

          }
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
        \Cache::put($key, $outData, config('app.cacheTime_g'));
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
                $txt = @str_replace("\n\n","\n",$txt);
                $txt = @str_replace("\n","\n\n",$txt);
                $txt = @str_replace("&nbsp;"," ",$txt);
                $txt = @str_replace("<","&lt;",$txt);
                $txt = @str_replace(">","&gt;",$txt);
            }else {
                txtLog($txtDir,$attachment,$curl->http_status_code);
            }

        }elseif ($curl->http_status_code == '404') {
          \Log::error('章节可能丢失',['路径'=>$txtDir,'状态码'=>$curl->http_status_code]);
        }
        else{
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
    if (config('app.txtlog')) {

        if (!empty($attachment)) {
          $ms = 'txt内容获取失败 有附件提示可能是图片 状态码不是200 代表txt文件不存在';
        }else{
          $ms = 'txt内容获取失败 状态码不是200 代表txt文件可能不存在';
        }

        \Log::info($ms,['路径'=>$txtDir ,'状态码'=>$http_status_code]);
    }

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
?>
