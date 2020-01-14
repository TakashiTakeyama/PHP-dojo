<?php

require 'sample.txt';

$time = time();
echo $time;

$now = mktime(0, 0, 0, 7, 1, 2000);
echo $now;

$time = date('Y m d H i s', $time);
echo $time;

function check_date($month, $day, $year)
{
  print '正しい日付を入力してください。';
}

// 使用するデフォルトのタイムゾーンを指定します。PHP 5.1 以降で使用可能です。
date_default_timezone_set('UTC');


// 結果は、たとえば Monday のようになります。
echo date("l") . "\n";

// 結果は、たとえば Monday 8th of August 2005 03:12:46 PM のようになります。
echo date('l jS \of F Y h:i:s A') . "\n";

// 結果は July 1, 2000 is on a Saturday となります。
echo "July 1, 2000 is on a " . date("l", mktime(0, 0, 0, 7, 1, 2000)) . "\n";

/* 書式指定パラメータに、定数を使用します。 */
// 結果は、たとえば Wed, 25 Sep 2013 15:28:57 -0700 のようになります。
echo date(DATE_RFC2822) . "\n";

// 結果は、たとえば 2000-07-01T00:00:00+00:00 のようになります。
echo date(DATE_ATOM, mktime(0, 0, 0, 7, 1, 2000)) . "\n";

$filename = "sample.txt";
if (is_readable($filename)) {
  $contents = file_get_contents($filename);
  echo $contents;
  print($contents);
} else {
  echo $filename . 'は読み込めません。';
}

//echoとprintの違い「echoは式では無い、printは式である」printは引数として使える、戻り値もあり1である。
/**
 * ディレクトリのなかのファイルを全て表示させるには
 * 
 * foreach (glob("*") as $filename) {
 *    *は全てのファイル名にマッチする　テスストファイルだけをマッチさせたい場合は "*.txt" とする。
 *    print($filename) . "<br>\n";
 * }
 * 
 * パス情報の取得
 * $file_info = pathinfo(__FILE__);
 * print($file_info['dirname']); ディレクトリ名
 * print($file_info['basename']); ファイル名
 * print($file_info['extension']); 拡張子
 * 
 * リクエストは method, header, dataで構成された文字列。
 * レスポンスは header, dataで構成される。
 */

//  $downloadfile = "data.csv";
//  header("Content-Disposition: attachment;
//  filename=$downloadfile");
//  header("Content-type: application/octet-stream;
//  name=$downloadfile");
//  $result = file_get_contents("test.data");
//  print($result);

//  // PDFを出力します
// header('Content-Type: application/pdf');

// // downloaded.pdf という名前で保存させます
// header('Content-Disposition: attachment; filename="downloaded.pdf"');

// // もとの PDF ソースは original.pdf です
// readfile('original.pdf');

// //リダイレクト
// header("Location: http://book.mynavi.jp");
// exit;

//正規表現のマッチ preg_match(正規表現, 文字列);
// $number = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
$number = "123456789";
$result = preg_match('/[0-9]+/', $number);
//これは文字列ではなく配列になるのでerrorになる。
echo $result;
echo "これで良いのだ！\n";

// get host name from URL
preg_match('@^(?:http://)?([^/]+)@i',
    "http://www.php.net/index.html", $matches);
$host = $matches[1];
//FQDNを表示
echo $host . "\n";

// get last two segments of host name
preg_match('/[^.]+\.[^.]+$/', $host, $matches);
echo "domain name is: {$matches[0]}\n";
//ドメイン名: インターネット上のネットワークの名前 例: arearesearch.co.jp
//ホスト名: ネットワーク内のコンピュータの名前 例: www
//FQDN(Fully Qualified Domain Name：完全修飾ドメイン名) 例: www.arearesearch.co.jp

$number = "123456789";
//第三引数に変数を渡すことでその変数から参照させることができる 戻り値は配列、中身は文字列
if (preg_match("/[0-9][0-9][0-9]/", $number, $matches)) {
  echo gettype($matches) . "\n";
  print $matches[0];
  $foo = $matches[0];
  echo "naze??";
  echo gettype($foo);
  print_r($matches);
}

$data = array(1, 1., NULL, new stdClass, 'foo');

foreach ($data as $value) {
    echo gettype($value), "\n";
}

$str = "TEL:03-0000-0081(代表)";
$tel = substr($str, 4, 12);
echo $tel;

$data = array("a", "b", "c", "d");
$last = array("e", "f", "g", "h");
$val = array_pop($data);
print_r($last);
print_r(array_unshift($last, $val));
var_dump($last);

$time = time();
echo $time;
$date = new DateTime();
echo $date->format('Y-m-d H:i:s');
// print $now;

$time = time();
$now = date('Y-m-d-h', $time);
"\n";
echo "ここだ" . "\n";
echo $now;
