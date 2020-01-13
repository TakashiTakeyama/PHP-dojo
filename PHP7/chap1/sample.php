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
