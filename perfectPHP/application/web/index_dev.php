<?php

//MiniBlogApplicationを生成する際にデバッグモードをtrueに設定している点
//これから開発を行って行く際はこのindex_dev.phpを指定するようにする

require '../bootstrap.php';
require '../MiniBlogApplication.php';

$app = new MiniBlogApplication(true);
$app->run();