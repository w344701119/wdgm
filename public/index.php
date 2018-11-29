<?php
//导入自动加载类
require __DIR__.'/../bootstrap/autoload.php';
//导入app类
require __DIR__ . '/../bootstrap/application.php';

//运行APP类；
$app=application::run();
//实例化一个处理类
$handel = new app\lib\RequestHandle($app);
$handel->handle();



