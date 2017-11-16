<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once './src/QcloudApi/QcloudApi.php';


$config = array('SecretId'       => 'AKID43rVyEg4d3HRUPuh4FJCsRtAGG77smKi',
                'SecretKey'      => 'MYWQ8kBTZaS8dx52oPq6QeeVElCXYRBj',
                'RequestMethod'  => 'GET',
                'DefaultRegion'  => 'gz');

$cvm = QcloudApi::load(QcloudApi::MODULE_YUNSOU, $config);

$package = array(
          'Action' => 'DataManipulation',
          'appId' => '1255477219',
          'contents.0.NA'=> '2000',
          'contents.0.TA' => 'testFDSF',
          'contents.0.TB' => 'testtiFDSAFASDe1',
          'op_type' => 'add',
          'SignatureMethod' =>'HmacSHA256'
          );

$a = $cvm->DescribeInstances($package);
// $a = $cvm->generateUrl('DescribeInstances', $package);

if ($a === false) {
    $error = $cvm->getError();
    echo "Error code:" . $error->getCode() . ".\n";
    echo "message:" . $error->getMessage() . ".\n";
    echo "ext:" . var_export($error->getExt(), true) . ".\n";
} else {
    var_dump($a);
}

echo "\nRequest :" . $cvm->getLastRequest();
echo "\nResponse :" . $cvm->getLastResponse();
echo "\n";
