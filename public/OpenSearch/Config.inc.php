<?php
//引入头文件
require_once("Autoloader/Autoloader.php");
use OpenSearch\Client\OpenSearchClient;

//替换对应的access key id
$accessKeyId = 'LTAIG0RPJfKfCCah';
//替换对应的access secret
$secret = 'kY8vXQM0ZWowOspSiwdMmqhCSeOWqP';
//替换为对应区域api访问地址，可参考应用控制台,基本信息中api地址
$endPoint = 'http://opensearch-cn-qingdao.aliyuncs.com';
//替换为应用名
$appName = 160000897;
//替换为下拉提示名称
$suggestName = '';
//开启调试模式
$options = array('debug' => true);
//创建OpenSearchClient客户端对象
$client = new OpenSearchClient($accessKeyId, $secret, $endPoint, $options);
