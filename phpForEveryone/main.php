<?php

require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('php-for-everyone');
$log->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));
$log->info('Composer');