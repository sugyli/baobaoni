<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use OpenSearch\Client\OpenSearchClient;
use OpenSearch\Client\DocumentClient;


class PushBook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pushbook:xiaoshuo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '给搜索引擎上传数据';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $accessKeyId = config('app.accessKeyId');
      $secret = config('app.secret');
      //替换为对应区域api访问地址，可参考应用控制台,基本信息中api地址
      $endPoint = config('app.endPoint');
      //替换为应用名
      $appName = config('app.aliAppName_sosuo');
      //开启调试模式
      $options = array('debug' => false);

      $tableName = 'xiaoshuo';
      $client = new OpenSearchClient($accessKeyId, $secret, $endPoint, $options);
      //创建文档操作client
      $documentClient = new DocumentClient($client);

      $total = \DB::table('jieqi_article_article')->count();
      $pageSize = 500;
      //计算总页数
      $pagenum = (int)ceil($total / $pageSize);//当没有数据的时候 计算出来为0

      $startpage = 1;
      $endpage = $pagenum;
      $path = storage_path()."/sosuopage.txt";

      if(is_file($path) && $lastpage = file_get_contents($path)){

          $startpage = (int)$lastpage;

      }

      if($startpage >$pagenum){
          $startpage = $pagenum;
      }
      $jisu = 0;
      for ($i=$startpage; $i <= $endpage; $i++) {
            $this->info("========开始获取第{$i}页数据=========");
            $jisu++;
            //开始的索引
            $offset = ($i - 1) * $pageSize;

            $books = \DB::table('jieqi_article_article')
                  //  ->where('lastchapterid','>',0)
                    ->orderBy('articleid', 'asc')
                    ->offset($offset)
                    ->limit($pageSize)
                    ->get();
            //添加数据
            $docs_to_upload = array();
            foreach ($books as $key => $book) {
              $this->info("========获取到{$book->articleid}编号的书=========");
                $item = array();
                $item['cmd'] = 'ADD';
                if($book->imgflag > 0){
                    $price = floor($book->articleid / 1000)
                                      . '/' . $book->articleid . '/'
                                      . $book->articleid . 's.jpg';
                }else{
                    $price = 'nopic';
                }

                $item["fields"] = array(
                  "id" => $book->articleid,
                  "title" => $book->articlename,
                  "author" => $book->author,
                  "create_timestamp" => $book->postdate,
                  "update_timestamp" => $book->lastupdate,
                  "bookid" => $book->articleid,
                  "from" => 1,
                  "slug" => $book->articlename,
                  "price" => $price,
                );
                $docs_to_upload[] = $item;
            }
            $json = json_encode($docs_to_upload);
            //提交推送文档
            $ret = $documentClient->push($json, $appName, $tableName);
            if(isset($ret->result)){
              $return = json_decode($ret->result, true);
              if ('OK' != $return['status']) {
                $this->info("========上传搜索数据返回结果状态不对 页码 {$i} 状态码 {$return['status']}=========");
                \Log::info('上传搜索数据返回结果状态不对',['页码'=> $i ,'状态码'=>$return['status']]);
                return false;
              }

            }else{
              $this->info("========上传搜索数据返回结果出错 页码 {$i}=========");
              \Log::info('上传搜索数据返回结果出错',['页码'=> $i ]);
              return false;
            }

            //延迟10秒，高级版主表增量90%，10秒内生效，99%在10min内，附表暂不保证。
            file_put_contents($path, $i);
            $this->info("========上传第{$i}页成功 我要睡15秒再继续=========");
            sleep(15);

      }
      $this->info("========总共上传了{$jisu}页数据 一共有 {$total} 本书=========");
      \Log::info("阿里云上传结束总共上传了{$jisu}页数据 结束页码{$endpage}");
      return true;

    }

}
