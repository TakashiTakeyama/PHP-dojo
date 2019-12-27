<?php

namespace Project\Module;

require_once 'Foo/Bar/Baz.php';  //Foo\Bar\Bazクラス
require_once 'Hoge/Fuga.php';    //Hoge\Fugaクラス
require_once 'Module/Klass/Some.php';  //Module\Klass\Someクラス

use Foo\Bar as BBB;
use Hoge\Fuga;

class Piyo {}

$obj1 = new \Directory(); //完全修飾なのでグローバルのDirectoryクラス

$obj2 = new BBB\Baz();  //エイリアスに基づいてコンパイル時にFoo\Bar\Bazクラスになる。

$obj3 = new Fuga(); //インポートルールに基づいてコンパイル時にHoge\Fugaクラスとなる。

$obj4 = new Klass\Some(); //修飾名で該当するインポートルールが無いため、コンパイル時に現在の名前空間である
// Project\Module\が先頭につけられ、Project\Module\Klass\Someクラスと解釈される。

$obj5 = new Piyo(); //非修飾名で該当するインポートルールが無いため、コンパイル時の変換はない。
//実行時に現在の名前空間が先頭に付与されたProject\Module\Piyoクラスと解釈される。

some_func(); //実行時にProject\Module\some_func()関数を探し、なければグローバル関数を実行

BBB\SOME_CONST; //コンパイル時にFoo\Bar\SOME_CONST定数に変換される

SOME_CONST; //実行時にProject\Module\SOME_CONSTがなければグローバルのSOME_CONST定数が評価される。

$class_name = 'Project\Module\SomeClass';
$obj = new $class_name(); // new Project\Module\SomeClass()
//文字列の定義にダブルクオートを用いると、\はエスケープ文字としてみなされてしまうため\\とする必要がある。
$namespace = "Project\\Module";

/*名前空間の名前解決のプロセスは、コンパイル時の変換と実行時の
名前解決という2つのプロセスからなる。
変数に文字列を代入する形での動的な名前空間の利用は、コンパイル時には変数の中身を知ることができないため
コンパイル時の変換を行うことができない、したがってuseによるエイリアスを動的な名前空間として利用することはできません。
