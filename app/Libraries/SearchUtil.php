<?php

namespace App\Libraries;
use OpenSearch\Client\OpenSearchClient;
use OpenSearch\Client\DocumentClient;
use OpenSearch\Client\SearchClient;
use OpenSearch\Util\SearchParamsBuilder;

class SearchUtil
{
  const DOC_ADD = 'add';
  const DOC_REMOVE = 'delete';
  const DOC_UPDATE = 'update';


  protected $client;
  protected $tableName;
  public function __construct()
  {
      $accessKeyId = config('app.accessKeyId');
      $secret = config('app.secret');
      //替换为对应区域api访问地址，可参考应用控制台,基本信息中api地址
      $endPoint = config('app.endPoint');
      //替换为应用名
      $appName = config('app.aliAppName_sosuo');
      //开启调试模式
      $options = array('debug' => true);

      $this->tableName = 'xiaoshuo';
      $this->client = new OpenSearchClient($accessKeyId, $secret, $endPoint, $options);
  }

}
