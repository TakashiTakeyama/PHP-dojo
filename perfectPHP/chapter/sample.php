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

// インターフェイス 'iTemplate' を宣言する
// interface iTemplate
// {
//     public function setVariable($name, $var);
//     public function getHtml($template);
// }

// インターフェイスを実装する。
// これは動作します。
// class Template implements iTemplate
// {
//     private $vars = array();

//     public function setVariable($name, $var)
//     {
//         $this->vars[$name] = $var;
//     }

//     public function getHtml($template)
//     {
//         foreach($this->vars as $name => $value) {
//             $template = str_replace('{' . $name . '}', $value, $template);
//         }

//         return $template;
//     }
// }

// これは動作しません。
// Fatal error: Class BadTemplate contains 1 abstract methods
// and must therefore be declared abstract (iTemplate::getHtml)
// class BadTemplate implements iTemplate
// {
//     private $vars = array();

//     public function setVariable($name, $var)
//     {
//         $this->vars[$name] = $var;
//     }
// }

interface FooInterface
{
  
}

class ParentFoo
{

}

class Foo extends ParentFoo implements FooInterface
{
  
}

class Bar
{

}

$a = new Foo();
var_dump($a instanceof Foo);
var_dump($a instanceof ParentFoo);
var_dump($a instanceof FooInterface);
var_dump($a instanceof Bar);

$param = isset($argv[1]) ? $argv[1] : 'default';
echo $param;

function some_func() {
  $val = '...'; //何かしらロジックを書いたとする。
  return $val;
}

$result = some_func() ? some_func() : 'default';
//上記と同義である。
$result = some_func() ?: 'defalut';
//PHPの結合規則は左結合である。
$flag1 = true;
$flag2 = false;
echo $flag1 ? 1 : $flag2 ? 2 : 0, PHP_EOL;
//実際の評価
echo( ( $flag1 ? 1 : $flag2) ? 2 : 0),PHP_EOL;
//最初に$flag1が評価されるので評価は1その後1が評価されるので評価は2になる。
$b = $a = 2 * 3 + 5;

echo $a, PHP_EOL;
echo $b, PHP_EOL;

//エラー制御演算子@は、その式で発生するエラーを抑制する。
$var = @$_GET['foo'];
echo $var;

//実行演算子``外部のシェルコマンドを実行する為の演算子
//オプションi大文字小文字を区別しない、rディレクトリ内も検索する、検索結果に行番号を表示する。
// $result = `grep -irn php *`;
echo $result;

$fruits = array(
  'apple',
  'banana',
  'orange',
); 

echo $fruits[0], PHP_EOL;
//空のブラケットによる配列の初期化は初めての変数に対してのみ有効、複数のデータ型が入り混じるような配列もつくることができる。

$fruits_color = array(
  'apple' => 'red',
  'banana' => 'yellow',
  'orange' => 'orange',
);

echo $fruits_color['banana'], PHP_EOL;

$fruits_mixed = array(
  'peach',
  'blueberry',
  'apple' => 'red',
  'banana' => 'yellow',
  'orange' => 'orange',
); 

$array = array(
  4,
  5,
  1 => "これは1",
  'string_key' => '最初の定義',
  'string_key' => '次の定義',
);
//初期化時にキーが重複していた場合、後に定義された要素が上書きされる。
echo var_dump($array);

//多次元配列
$fruits = array(
  'apple' => array(
    'price' => 100,
    'count' => 2,
  ),

  'banana' => array(
    'price' => 80,
    'count' => 5,
  ),

  'orange' => array(
    'price' => 90,
    'count' => 3,
  ),
);

foreach ($fruits as $name => $value) {
  echo "$name は 一つ {$value['price']} 円で、{$value['count']}個です", PHP_EOL;
}
//配列の結合は、左辺にも同じキーを持つ要素があればそれは上書きされない。array_merge()関数が一つまたは複数の配列をマージする。
//配列のキーがセットされているか確認する方法 array_key_exists()という関数がある。issetでも調べることができる。
$array = array('hoge' => 1, 'fuga' => 2,);
echo array_key_exists('hoge', $array), PHP_EOL;//内部的には引数に渡したkeyが配列内に存在するか全てしらべる為時間がかかる。
echo isset($array['hoge']);//配列ないにセットされているかどうかだけ調べるので、時間が短縮できる。

//逐次実行

$array = array(1,2,3,4,5);
for ($i = 0, $end = count($array); $i < $end; ++$i) {
  echo $array[$i], PHP_EOL;
}

foreach ($array as $value) {
  echo $value, PHP_EOL;
}

$fruits_color = array(
  'apple' => 'red',
  'banana' => 'yellow',
  'orange' => 'orange',
);

foreach ($fruits_color as $name => $color) {
  echo "このフルーツは".$name."です。".$color . "色です。", PHP_EOL;
}
//unset 指定した変数の割り当てを解除する。
//通常foreachの反復に参照を用いることは推奨されない、ブロックスコープがない為、上記の$color変数はforeachブロックを抜けた後も値が維持される
//だから最後にunsetを関数を用いて割り当てた変数を解除する。
foreach ($fruits_color as &$color) {
  $color = 'black';
}

foreach ($fruits_color as $name => $color) {
  echo "このフルーツは".$name."です。".$color . "色です。", PHP_EOL;
}
//unset 指定した変数の割り当てを解除する。

foreach ($fruits_color as $name => $color) {
  // echo "このフルーツは".$name."です。".$color . "色です。", PHP_EOL;
}
var_dump($fruits_color);
unset($color);
var_dump($fruits_color);
unset($color);
//unset 指定した変数の割り当てを解除する。

//リファレンス渡し
//PHPでリファレンスとは同じ変数の内容を違う名前でコールする事
function foo(&$var)
{
    $var++;
}

$a=5;
foo($a);
// $a はここでは 6 です

$dice = range(1,6);
shuffle($dice);
foreach ($dice as $value) {
  echo "サイコロの目は" . $value . "です。", PHP_EOL;
  if ($value === 6) {
  break;
  }
}

$hour = date('G');
if ($hour === '6') {
  echo "朝の６時です。", PHP_EOL;
} elseif ($hour === '12') {
  echo "正午です、こんにちは";
}

switch ($hour) {
  case '6':
    echo "朝の６時です。";
  break;
  case '12':
    echo "正午です、こんにちは。";
  break;
  default:
    echo "どうも";
  break;
}
/*requireとrequire_onceでは、読み込む対象のファイルが存在しないとerrorになる(fatal)依存しているライブラリやファイルがを読み込まないと
プログラムの実行に支障をきたすときに使う。
require_onceは一度読み込んだファイルは二度と読み込まない、クラスや関数の定義がされているファイルを二度読み込むと同じ名前のクラスを二度定義できないと
errorが出る。*/

/*読み込んで
require 'some.php';
読み込んだファイルに定義されているクラスを使用できる。
$obj = new SomeLib;
読み込んだファイルに何らかの処理や出力が実行される物が記述されていると読み込んだ時点で実行されてしまう。
include と include_onceは読み込めなくてもFatalerrorにはならない。
*/

// if ($is_error) {
//   goto error;
// }

// error:
//   echo "エラーが発生しました。",PHP_EOL;
//   exit(1);
  //一般的にはあまり利用されていない。

//PHPでは標準で多くのグローバル関数が定義されている為、関数名が衝突しないようにする、アプリケーション名やモジュール名を接頭語としてつけ、アンダースコアーで繋ぎ関数名にする。
function mymodule_abs($num) {
  if ($num < 0) {
    return - $num;
  }
  return $num;
}
/*PHPの関数では引数や返り値に型を指定しない為どのような変数でも引数に渡すことができる。
タイプヒンティングという手法があり渡される値を特定のクラスまたは配列にすることができる。*/
function array_output(array $var) {
  if (is_array($var)) foreach($var as $v) {
    echo $v, PHP_EOL;
  }
}

$array = array(1,2,3);
array_output($array);
// array_output(1);

echo "初めまして", PHP_EOL;
/*関数はいかなるタイミングや場所で実行されようとも、定義時のコンテキストで実行される。
クロージャは関数とその関数の定義時のコンテキストをセットにした特殊なオブジェクト
なぜクロージャを使うか？クロージャはテクニックにすぎない
グローバル変数を使わずに状態を保持させる為
関数をつくる関数*/

$array = array(1, 1.5, "2", true);
$new_array = array_map('strval', $array);
var_dump($new_array);

//コールバック関数: 引数に関数を指定すると特定の処理にその関数を呼び出すような関数があるそれをコールバック関数という。
function func_caller($name)
{
  if (function_exists($name)) {
    $name();
  }
}

function moo()
{
  echo 'moo called', PHP_EOL;
}
/*この例ではmooという引数を指定してfunc_callerを呼び出している。
function_exists();は組み込みの関数*/
func_caller('moo');

function add($v1, $v2)
{
  return $v1 + $v2;
}

class Math
{
  public function sub($v1, $v2)
  {
    return $v1 - $v2;
  }

  public static function add($v1, $v2)
  {
    return $v1 + $v2;
  }
}

call_user_func('add', 1, 2);
/*call_user_func ( callable $callback [, mixed $parameter [, mixed $... ]] ) : mixed
最初の引数で指定したコールバック関数をコールする。*/

// error_reporting(E_ALL);
function increment(&$var)
{
    $var++;
}

$a = 0;
call_user_func('increment', $a);
echo $a."\n";

// このようにしてもかまいません
call_user_func_array('increment', array(&$a));
echo $a."\n";

function add_one(&$value)
{
  $value += 1;
}

$a = 10;
add_one($a);
echo $a, PHP_EOL;
//値渡しではなく、参照で渡される為グローバル変数の$aのそのものの値が変更されている。引数を参照で受け取る関数には、値を直接渡すことはできず、必ず変数でないといけない。

function &add_onee(&$value)
{
  $value += 1;
  return $value;
}
$a = 10;
$b =& add_onee($a);
$b += 1;
echo $b, PHP_EOL;
echo $a, PHP_EOL;
//関数の返り値に参照を用いたい場合は、関数名の前に&をつけて関数を定義する。
/*PHPは可変関数がある、変数名の後ろに()をつけることで同名の関数を呼び出すことができる。*/
function callback_func()
{
  return "foo";
}

function func($callback)
{
  echo "callbackfunction result :" . $callback() . PHP_EOL;
}

/*func("callback_func");//=>:callbackfunction result :foo
//無名関数、一見可変関数のように呼び出すが、文字列で定義された関数名を呼び出すのではなく、その変数自体が関数オブジェクトである。
/*関数の返り血に参照を用いたい場合は、関数名の前に&をつけて関数を定義します。
また返り値を受け取る際、代入演算子にも&をつける必要がある。*/

function &add_oneee(&$value)
{
  $value += 1;
  return $value;
}

$a = 10;
$b =& add_oneee($a);
$b += 1;
echo "よろしく", PHP_EOL;
echo $a, PHP_EOL;

$add = function($v1, $v2)
{
  return $v1 + $v2;
};
//指定した配列の要素にコールバック関数を適用する。
$escaped = array_map(function($value){
  /*htmlspecialchars 特殊文字をhtmlエンティティに変換する、ENT_QUOTES シングルクオートとダブルクオートを共に変換する。*/
  return htmlspecialchars($value, ENT_QUOTES);
}, $array);

var_dump($escaped);

function cube($n)
{
  return($n * $n * $n);
}
$a = array(1,2,3,4,5);
$b = array_map("cube", $a);

var_dump($b);

//クロージャ
$my_pow = function($times = 2)
{
  return function($v) use (&$times)
  {
    return pow($v, $times);
  };
};

$cube = $my_pow(3);
echo $cube(1), PHP_EOL;
echo $cube(2), PHP_EOL;

// $array = array(1,2,3,4,5);
// array_map(create_function('$v', 'return $v * 2;'),$array);
// var_dump($array);
//難しい
$v = array(1,2,3,4,5);
// echo "aaaaa";
$arr = array_map(function($v) { return $v * 2; }, $array);
var_dump($arr);
print_r($arr);

function myrow($id, $data)
{
    return "<tr><th>$id</th><td>$data</td></tr>\n";
}

//組み込み関数、ユーザー定義関数共に登録されている関数が表示される。
$arr = get_defined_functions();

print_r($arr);