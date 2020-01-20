<?php

//trim: 最初及び最後から空白の文字列を取り除き取得する。

$str = fgets(STDIN);
// echo $str;

// $str = fgetc(STDIN);
//一文字だけを取り出す。
// echo $str;

// $stdin = trim(fgets(STDIN));
// echo $stdin;

// $huga = array(
//   'name' => 'takashi'
// );
// print_r($huga);

// $arr = [];

function user_array($str) {
  $arr = [];
  //以下のよう書かないとstringになる
  $arr[] = $str;
  // echo gettype($arr) . "\n";
  // print_r($arr);
  return $arr;
}

$result = gettype(print_r(user_array($str)));
//戻り値はboolian
print $result;