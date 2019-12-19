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

echo $foo;
