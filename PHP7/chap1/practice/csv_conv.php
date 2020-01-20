<?php

// $file_name = "/Users/takeyamatakashi/PHP/dotinstall/PHP7/chap1/practice/test.txt";
$file_name = "PHP7/chap1/practice/test.txt";
$url = "https://www.wantedly.com/";

$hundle = fopen($file_name, "r+");
$result = fgets($hundle);
echo gettype($result) . "\n";
echo $result;
// $hundle = fopen($url, "r");

// foreach($hundle as $result) {
//   echo $result;
// };

//複数行読み込むには
//file_get_contents(): 改行もしてくれる。
$hundle = file_get_contents($file_name);
echo $hundle . "\n";

//readfile(): ファイルの内容を読み込み全て出力する。
$hundle = readfile($file_name);
