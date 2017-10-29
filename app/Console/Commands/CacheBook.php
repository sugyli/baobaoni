<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;

class CacheBook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:webbook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成缓存';

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
        $curl = new \Curl\Curl();
        $curl->setOpt(CURLOPT_TIMEOUT, 5);

        $total = \DB::table('jieqi_article_article')->count();

        $pageSize = 200;
        //计算总页数
        $pagenum = (int)ceil($total / $pageSize);//当没有数据的时候 计算出来为0
        for ($page=1; $page <= $pagenum; $page++) {

              //开始的索引
              $offset = ($page - 1) * $pageSize;
              $books = \DB::table('jieqi_article_article')
                      ->where('lastchapterid','>',0)
                      ->orderBy('articleid', 'asc')
                      ->offset($offset)
                      ->limit($pageSize)
                      ->get();
              foreach ($books as $key => $book) {
                  if (empty($book->slug)) {
                      $url =  route('web.articles.show', ['bid' => $book->articleid]);
                  }else{
                      $url = route('web.articles.show', ['bid' => $book->articleid ,'slug' => $book->slug]);

                  }
                  $key = 'bookid_'.$book->articleid;
                  \Cache::forget($key);
                  $curl->get($url);
                  if($curl->http_status_code == '200'){
                      $this->info("========创建 {$url} 缓存成功==========");
                  }else{
                      $this->info("========创建 {$url} 缓存失败 状态码 {$curl->http_status_code}==========");
                  }
              }
        }

        $curl->close();

    }

}
