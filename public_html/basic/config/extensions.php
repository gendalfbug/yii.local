<?php
//use yii\helpers\ArrayHelper;
//
//$extensionsDir = dirname(__DIR__). DIRECTORY_SEPARATOR . 'extensions';
//$vendoExtension =  require_once  dirname(__DIR__).'/vendor/yiisoft/extensions.php';
//
//Yii::setAlias('@extensions', $extensionsDir);
//
//$extensions = [
//    'jqgrid'=>[
//        'name' => 'jqgrid',
//        'version' => '4',
//        'bootstrap' => 'BootstrapClassName',  // optional, may also be a configuration array
////        'alias' => [
////            '@alias1' => 'to/path1',
//////            '@alias2' => 'to/path2',
////        ],
//    ]
//];
//
//foreach ($extensions as $extension) {
//    if (isset($extension['alias'])) {
//        foreach ($extension['alias'] as $alias => $path) {
//            Yii::setAlias($alias, $path);
//        }
//    }
//}
//
//$merge = ArrayHelper::merge(
//    $extensions,
//    $vendoExtension
//);
//
//return $merge;