<?php
require_once('user.php');


$arr = array(
  'name',
  'email',
  'age'
);

// print_r($arr);

$hoge = [
  'suki',
];

$new_user = new User();
$user = $new_user->user_info('タカシ', 'email', 35);
echo gettype($user);

var_dump($user);

// $arr = array_merge($arr, $hoge);

// print_r($arr);



