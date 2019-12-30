<?php

require 'core/ClassLoader.php';

$loader = new ClassLoder();
$loader->registerDir(dirname(__FILE__).'/core');
$loader->registerDir(dirname(__FILE__).'/models');
$loader->register();