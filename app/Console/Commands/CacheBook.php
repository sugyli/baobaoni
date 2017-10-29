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
        $url = route('web.articles.show', ['bid' => 1]);
        echo $url;
        /*
        for ($i=205; $i < 10000; $i++) {
          $url = route('web.articles.show', ['bid' => $i]);
          $curl->get($url);
          if($curl->http_status_code == '200'){
              $this->info("========创建 {$i} 缓存成功==========");
          }else{
              $this->info("========创建 {$i} 缓存失败 状态码 {$curl->http_status_code}==========");
          }

        }
        */
        $curl->close();

    }

}
