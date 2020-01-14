<?php
/**
 * trait トレイト名1{
 * 処理
 * }
 * 
 * trait トレイト名2{
 * 処理
 * }
 * 
 * class クラス名{
 * use トレイト名1, トレイト名2
 * }  
 * 
 * PHPではクラスを多重継承できなかったが traitにより同様の処理が行えるようになった
 * トレイトにはメソッドやプロパティ、staticなメンバを設定できる
 * */

trait Trait1{
	function workItem1(){
		echo 'Processing of Trait1.<br>';
	}
}
 
trait Trait2{
	function workItem2(){
		echo 'Processing of Trait2.<br>';
	}
}
 
class ChildClass{
	//useで使用するトレイトを指定する
	use Trait1, Trait2;
 
	function workItem3(){
		echo 'Processing of ChildClass.<br>';
	}
 
}
 
//インスタンスの生成
$child = new ChildClass();
 
//メソッドの呼出し
$child->workItem1();
$child->workItem2();
$child->workItem3();

$data = 5;
function set_number() {
  // $data = 0;
  // global $data;
  $GLOBALS['data'] += 1;
  // $data += 1;
  // print $data;
}

print $data;
print "<br>";

set_number();

print "<br>";
print $data;

for ($i = 0; $i <= 10; $i++) {
  print $i;
  print "<br>";
}
function register($str) {
  if ($str === "登録") {
    echo '登録しました。';
  } else {
    echo '登録できませんでした。';
  }
}

register("登録");

$member = array("name" => "takashi",
                "tel" => "090-2983-3749",
                "address" => "東京都杉並区");

foreach ($member as $key => $value) {
  echo $key . 'は' . $value . 'です。' . "\n";
}
/**
 * 変数の中身を表示したい場合はダブルクォーテーションを使う
 * 変数を直接表示したい場合はシングルクォーテーションを使う
 */

function test($name) {
  echo "{$name}さん\nこんにちは!";
}

test("崇志");

$string = "loftの受付の子
めちゃくちゃ
可愛い";

$result = nl2br($string, false);
echo $string;
echo $result;

//implode(): 配列のデータを指定した文字で区切ったデータにすることができる。
$fruits = array('りんご', 'みかん', 'イチゴ', 'パイナップル');

//第一引数で区切る
echo $res = implode('and', $fruits);

$fruitss = "ichigo, mikan, pantu, daihuku, kuro, boludo";
$ress = explode(',', $fruitss);
// var_dump($ress);
// var_dump() $res = explode(',' $fruits);

$array = [];
// $array = array();
$array[] = "文字列 0";
$array[] = "文字列1 1";
$array[] = "文字列2 2";
// $array = "文字列3 3";

var_dump($array);

$array = array([34, 38, 25, 86,113, 112],[22,44,66,88]);
echo sort($array);

//print_r: 配列の構造を調べる
print_r($array);
//print($array); printは引数に配列しか受け付けないからerrorになる。

//rsort()で降順にできる、ソートの第二引数にフラグをつけることでいろいろな条件でソートできる
/**
 * array_push($array, "りんご" => 500);
 * これは追加できない
 */

$array = array("みかん" => 100);
$array += ["りんご" => 500];
print_r($array);
// $array -= ["りんご" => 500];
// print_r($array);

//array_pop()最後のデータを削除する
//array_unshift()最初のデータを削除する

$array = array("A", "B", "C", "D", "E");
//第三引数は長さインデックスでは無い
$res = array_slice($array, -3, 1);
print_r($res);

