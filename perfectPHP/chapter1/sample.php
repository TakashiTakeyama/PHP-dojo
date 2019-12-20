<?php
//どのようなerrorを報告するか設定することができる
//ちなみに下記はSTRICT以外とSTRICTも報告の二種類指定している。
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

$number = rand();
if ($number % 2 == 0) {
  //PHP_EOLは改行を表している。
  echo $number, "は偶数です。", PHP_EOL;
}
else {
  echo $number, "は奇数です。", PHP_EOL;
}

$a = 1;
$b = "foo bar";
$c = array(1,2,3);

//var_dump関数は変数の型や、値、オブジェクトの場合は保持しているプロパティ なども出力できる。
var_dump($a);

var_dump($b);

var_dump($c);

$var = 1;
//数字の変数名はできない。
// $2var = 2;
//変数がセットされている事を検査する、そしてNULLで無い事を検査する。
var_dump(isset($var));
// var_dump(isset($2var));2

$var = 1;
$var_name = 'var';
//まずvar_nameが評価され、その後にvarが評価される。
echo $$var_name, PHP_EOL;

$array = array(1,2,3,4,5);
foreach ($array as $i) {
  echo $i, PHP_EOL;
}
//foreachのスコープ 外でも$iは使える。グローバルスコープだから！
echo "Last: ", $i, PHP_EOL;

$foo = 1;

function some_function() {
  $foo = 10;
  $bar = 20;
  echo $foo;
}

some_function();
echo $foo, PHP_EOL;
//ローカルのスコープ内の変数なので使用できない。
//globalキーワードを使って使用できるようにする事はできる。
// echo $bar, PHP_EOL;

//スーパグローバルスコープ
$globals_test = 1;
echo $globals_test, PHP_EOL;
//$GLOBALS全てのグローバル変数への参照を持つ連想配列
echo $GLOBALS['globals_test'], PHP_EOL;

var_dump($_SERVER);

//実行時に、名前を指定して定数を定義する。
// define('BOOK', 'Perfect PHP');
// $value = 'BOOK';
// echo constant($value), PHP_EOL;

const BOOK = 'Perfect PHP';
echo BOOK;

// var_dump(get_defined_constants();
//マジック定数、その定数が記述された場所によって動的にその値が変化する定義すみ定数
//error種別
//Parse error シンタックスエラーの事
//Fatal error 致命的なエラー　
//Warning error 定義されていない関数などを呼び出すと表示される。
//Notice error 初期化も代入もされていない未知の変数や定数を出力に使おうとすると表示される。
//Deprecated error 使われている関数が非推奨の物だったりするときに表示される。
//Strict Standards 変更した方が望ましい記述が合ったときに表示される。

echo "テストプログラム開始", PHP_EOL;

// $ret1 = array_reverse();
// $ret2 = array_reverse(1);

echo "テストプログラム終了";

//最近では使われない、例外処理を使う為
trigger_error("このファイルを実行するべきではありません!", E_USER_WARNING);

//ヒアドキュメント 
$age = 15;

$foo = <<<EOI
ヒアドキュメントでは、このように、
複数行にわたる文章をそのまま表記することができます。
Tomの年齢は "$age"です。
PHP5.3からはドル文字が適切にエスケープされていればヒアドキュメント自体も
constに代入することができる。
EOI;

echo $foo, PHP_EOL;
//キャスト　変数などのデータ型を別の型に変換する事
//echoなどで出力する場合全て文字列型にキャストされる。
echo 15.0;
//クライアントが送信したものは全て文字列型になってしまう。
//引数として期待している値の型が決まっている場合、明示的にキャストを行い、厳密な比較演算子(===など)を用いる方が安全。
//PHPでは添字配列と連想配列が区別されておらず全て配列と呼ばれる。

$mysql = mysqli_connect('server','username','password');//MySQLサーバーへ接続
var_dump(get_resource_type($mysql));//リソース型はそれぞれの外部リソースの為の専用のリソースとなる為、キャストする事はできない。

//返り値を持たない関数の定義
function no_return_func() {

}

$null_value = no_return_func();
//Noticeが発生するだけで処理速度が大幅に遅くなる、PHPでは未定義の値を取得しようとしたときに、Noticeを発生しながらNULLを代わりに取得する。

//自動キャスト　異なるデータ型動詞で演算を行うとき場合　演算子、制御構造、関数やメソッドが特定の型引数を必要としているのにそれとは違った値を渡した場合
echo (float)'1effoo', PHP_EOL;
if ('0.0' == '0') {
  echo ' "0.0"と"0"は等しいです。',PHP_EOL;
}
//数値らしい文字列の場合整数型または浮動小数点型へとキャストするという性質がある

if ('0' === '0.0') {
  echo ' "0.0"と"0"は等しいです。';
} else {
  echo '等しくありません。';
}
//trueは1にキャストされる。"1.5"は1.5にキャストされる。

//ビット演算子 ビットに対する演算を行うことができる。
printf("%032b\n", 15);

$age = 15;
$tom = 'Tom is' . $age . 'years old.';
//$age文字列に自動キャストされる。
echo $tom, PHP_EOL;
//$argv スクリプトに渡された引数の配列

class SomeClass
{
}
$a = new SomeClass();

if ($a instanceof SomeClass) {
  echo '$a は SomeClass のインスタンスです。', PHP_EOL;
}