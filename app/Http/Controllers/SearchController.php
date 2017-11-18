<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenSearch\Client\OpenSearchClient;
use OpenSearch\Client\SearchClient;
use OpenSearch\Util\SearchParamsBuilder;

class SearchController extends Controller
{

    protected $client;
    protected $appName;
    public function __construct()
    {
        $accessKeyId = config('app.accessKeyId');
        $secret = config('app.secret');
        //替换为对应区域api访问地址，可参考应用控制台,基本信息中api地址
        $endPoint = config('app.endPoint');
        //替换为应用名
        $this->appName = config('app.aliAppName_sosuo');
        //开启调试模式
        $options = array('debug' => false);
        //替换为应用名
        //$this->tableName = 'xiaoshuo';
        $this->client = new OpenSearchClient($accessKeyId, $secret, $endPoint, $options);
    }

    public function alisearchview()
    {

      return view('mnovels.alisearch');

    }
    public function alisearch()
    {

        $query = \Purifier::clean(request('query'), 'search_q');

        $result = ['error'=>1,'message'=>'未知错误','bakdata'=>[]];
        if(empty($query)){
          $result['message'] = '搜索关键词不能为空';
          return response()->json($result);
        }

        // 实例化一个搜索类
        $searchClient = new SearchClient($this->client);
        // 实例化一个搜索参数类
        $params = new SearchParamsBuilder();
        //设置config子句的start值  从数据第几个开始取
        $params->setStart(0);
        //设置config子句的hit值 每次取几个
        $params->setHits(100);
        // 指定一个应用用于搜索
        $params->setAppName($this->appName);
        // 指定搜索关键词
        $params->setQuery("default:{$query}");
        //设置文档过滤条件
        $params->setFilter('from=1');
        // 指定返回的搜索结果的格式为json
        $params->setFormat("fulljson");
        //指定粗排表达式
        $params->setFirstRankName('title');
        //指定精排表达式
        $params->setSecondRankName('default');
        //添加排序，scroll只支持单字段排序，且字段类型必须是int
        //$params->addSort('bookid', SearchParamsBuilder::SORT_DECREASE);
        // 执行搜索，获取搜索结果
        $ret = $searchClient->execute($params->build())->result;
        // 将json类型字符串解码
        $ret = json_decode($ret,true);
        //分页支持这种
        if(!isset($ret['status']) || $ret['status'] != 'OK'){
          \Log::info('阿里搜索出现问题',['搜索词'=> $query ]);
          $result['message'] = '搜索服务器繁忙请稍后访问';
          return response()->json($result);
        }

        if($ret['result']['total'] <= 0){
          $result['message'] = '没有搜索到内容';
          return response()->json($result);
        }

        $result['error'] = 0;
        $result['message'] = '获取成功';
        $result['bakdata'] = $ret['result']['items'];
        return response()->json($result);

    }



}
