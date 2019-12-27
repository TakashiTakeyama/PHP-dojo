<?php

// $arr = get_defined_functions();
// print_r($arr);
/*php5以降で本格的なオブジェクトの機能が備わった。
クラスも関数と同様に、名前空間を使わない限り、グローバルに定義される
定義済のクラスとの名前の衝突問題が起こる、この問題は
関数と同様に名前空間に相当するものをアンダースコアで区切ってクラス名をつける事で対応する。
クラス名はアッパーキャメル*/
// class Employee
{
  /*アクセス修飾子publicはどこからでもアクセス可能
  protected: そのクラス自身と継承クラスよりアクセスする事ができる。
  private: 同じクラス内でのみアクセス可能です。*/

  // public function work()
  // {
  //   echo '書類を整理しております', PHP_EOL; 
  // }
}

$yamada = new Employee;
var_dump($yamada);
$yamada->work();
/*参照渡しをしなくても同じオブジェクトの値を指し示す値が渡されえると言う事*/
//複製したい場合はcloneを使う
$suzuki = clone $yamada;
//プロパティはクラスの中に保持している変数、クラスの定義時に同時に定義する。
class Employee
{
  const PARTTIME = 0x01;
  const REGULAR = 'レギュラー'; 
  const CONTRACT = 0x03;

  public $name;
  public $state = '働いている。';
  public static $company = '技術評論社';

  public static function getCompanyName()
  {
    return self::$company;
  }

  public static function setCompany($value)
  {
    self::$company = $value;
  }

  public function getState()
  {
    return $this->state;
  }
  public function getCompany()
  {
    //selfキーワードは特別なキーワードでクラスコンテキスト内ではクラス自身を表す。
    return self::$company;
  }

  public function setState($state)
  {
    $this->state = $state;
  }

  public function work()
  {
    echo '書類を整理しています。', PHP_EOL;
  }

  // public function __construct($name, $type)
  // {
  //   $this->name = $name;
  //   $this->type = $type;
  // }
}

// $yamada = new Employee;
$yamada->name = '山田';
echo $yamada->state, $yamada->name, 'さん:';
$yamada->work();
$yamada->setState("utunomiya");
echo $yamada->state, PHP_EOL;

//PHPは存在しないプロパティへの書き込みを行うと、その名前のpublicなプロパティが作成される。
$yamada->job = 'プログラマ';
echo $yamada->job;

/*staticプロパティ、静的なプロパティ
クラスがインスタンス化されなくても読み書きする事ができる。
staticプロパティはクラス名にダブルコロンをつけてアクセスする。::*/
echo '従業員は皆', Employee::$company, 'に勤めています。';
echo $yamada->getCompany();

//クラス定数は変数では無いので、$をつける必要は無い。
echo Employee::REGULAR;
echo Employee::PARTTIME;
//staticをつけて呼び出されたメソッドはインスタンス化されていなくても外部から直接呼び出すことができる。

/*コンストラクタとデストラクタ: インスタンスが作られるタイミングで実行される。*/
$yamada = new Employee('山田', Employee::REGULAR);
//__二つは特殊なメソッドでマジックメソッドと呼ばれる、自動的に呼び出されるメソッド

class Programmer extends Employee
{
  //privateは継承されない、メソッドのオーバーライドは引数名が違うとerrorになる。
  public function work()
  //デフォルト値を持たせる分には問題なし
  {
    echo 'プログラムを書いています。', PHP_EOL;
  }

  public function __construct($name, $type)
  {
    parent::__construct($name, $type); //親クラスのコンストラクタを呼び出し
    {

    }
  }

}

//public final function getSalary()finalをつける事で継承先のメソッドでオーバーライドできないようにする。

class SamuraiClass{
 
  public $val = 'Samurai';
 
  //メソッドの宣言
  public function SamuraiMethod(){
    $val = 'Engineer';
    
    echo $this->val;
  }
}
  
//インスタンスの生成
$class = new SamuraiClass();
//メソッドの呼出し
$class->SamuraiMethod();

$obj = new stdClass();
$obj->some_member = 1;
//プロパティやメソッドを持たないstdClassと呼ばれる標準クラスが定義されている。
//整数型など、他の型からオブジェクト型へキャストを行うとstdClassのインスタンスになる。

//スカラー型、データ型の一種

abstract class Employeee
{
  abstract public function work();
}

class Programmmer extends Employeee
{
  public function work()
  {
    //
  }
}

//インターフェイスとは複数の異なるクラスに共通の機能を実装するために、その実態を定義する事なく指定する仕組み
interface Reader
{
  public function read();
}

interface Writer
{
  public function write($value);
}

class Configure implements Reader, Writer
{
  public function write($value)
  {

  }

  public function read()
  {

  }
  //インターフェイスに定義されているメソッドを実装しないと致命的なerrorとなる。
  //タイプヒンティングは引数に渡される変数を、配列か特定のオブジェクトかをチェックする仕組み

}
class Foo
{
  public function bar (Iterator $itr)
  {

  }
}

class Fooo
{
  public function bar($itr)
  {
    if ($itr instanceof Iterator === false) {
      throw new InvalidArgumentException('Interface Error');
    }
  }
}

class Employeeee
{
  public function __toString()
  {
    return 'This class is:'. __CLASS__;
  }
}

$yamada = new Employeeee;
echo $yamada;

class SampleClass
{
    //プロパティの宣言
    //class/インスタンスから :: で参照ok
    public static $var = 'This is Sample Class.';
    //　インスタンス必須
    public $var2 = 'This is Sample Class.';
}

//インスタンスの生成
$ins= new SampleClass();

echo "class direct\n";
echo SampleClass::$var;
echo "koko\n";
echo SampleClass::$var;

echo "instanceから\n";
echo $ins::$var;

echo "\n--------------\n";


echo "staticはinstance変数ではとれない\n";
// echo $ins->var;                  // error
echo $ins->var2;                  // staticじゃないのはとれる

class SomeClass
{
  private $values = array();

  public function __get($name)
  {
    echo "get: $name", PHP_EOL;
    if (!isset($this->values[$name])) {
      throw new OutOfBoundsException($name . "not found");
    }
    return $this->values[$name];
  }

  public function __set($name, $value)
  {
    echo "set: $name setted to $value", PHP_EOL;
    $this->values[$name] = $value;
  }

  public function __isset($name)
  {
    echo "isset: $name", PHP_EOL;
    return isset($this->values[$name]);
  }

  public function __unset($name)
  {
    echo "unset: $name", PHP_EOL;
    unset($this->values[$name]);
  }

  public function __call($name, $args)
  {
    echo "call: $name", PHP_EOL;

    //アンダースコアをつけ、メソッド名とする。
    $method_name = '_' . $name;
    if (!is_callable(array($this, $method_name))) {
      throw new BadMethodCallException($name . " method not found.");
    }
    //プログラムの実行中に他の関数やメソッドを実行して呼び出すことをコールすると言う。

    //パラメータの配列を指定してコールバック関数を実行する
    return call_user_func_array(array($this, $method_name), $args);
  }

  public static function __callStatic($name, $args)
  {
    echo "callStatic: $name", PHP_EOL;
    $method_name = '_' . $name;
    if (!is_callable(array('self', $method_name))) {
      throw new BadMethodCallException($name . "method not found.");
    }
    return call_user_func_array(array('self', $method_name), $args);
  }

  private function _bar($value)
  {
    echo "bar called with arg '$value'", PHP_EOL;
  }

  private static function _staticBar($value)
  {
    echo "staticBar called with arg '$value'", PHP_EOL;
  }
}

$obj = new SomeClass();
/*この時、fooは宣言されていないプロパティなので、アクセス不能のプロパティの介入として、
__set()メソッが呼び出される。
この時の引数には、代入しようとしたプロパティ名"foo"と、代入しようとした値10が渡される
この値は、実際にはprivateなプロパティ$valueという配列に保存される。*/

$obj->foo = 10;
var_dump($obj->foo);
// $obj->foo;
var_dump(isset($obj->foo));
var_dump(empty($obj->foo));

// $take = new SomeClass();
// $take->__get("takashi");
unset($obj->foo);
var_dump(isset($obj->foo));
$obj->bar('baz');
//メソッドのオーバーロードでも、アクセス不能なメソッドへのアクセスが行われた場合には
//__call()や__callStatic()が代わりに呼ばれる。
SomeClass::staticBar('baz');

/*遅延静的束縛: 継承されたクラスのメソッドなどを親クラスで解決するための機能。
*/
class Foooo {
  public function helloGateway()
  {
    self::hello();
  }

  public static function hello()
  {
    echo __CLASS__, 'hello!', PHP_EOL;
  }
}

class Bar extends Foooo {
  public static function hello()
  {
    echo __CLASS__, 'hello!!', PHP_EOL;
  }
}

$bar = new Bar();
//親クラスから継承したhelloメソッドをコールしている。
$bar->helloGateway();

function __autoload($name)
{
  $filename = $name . '.php';
  //クラス名.phpというファイルが読み込めれば
  if (is_readable($filename)) {
    require $filename;
  }
}

/*この場合まだ Fooクラスの定義はまだ存在していないので__autoload()関数が
'Foo'を引数として呼び出す。*/
$obj = new Foo();

//名前空間とは、クラスや関数の使える名前の集合を限定し、関数名やクラス名の衝突を塞いだり、
//機能の参照をわかりやすくするための機能です。

// namespace Food\Sweets;

// class Cake
// {

// }

// require_once 'Cake.php';
// $c = new Food\Sweets\Cake();
//名前空間の影響を受けるのはクラス、関数、定数(constによって定義されるものに限る)
/*
namespace Project\Module;

class Directory {} Project\Module\Directory クラス
function file() {} Project\Module\file 関数
const E_ALL = 0x01;Project\Module\E_ALL 定数
$var = 0x01;       変数に名前空間は適用されない。
同じ名前空間では、名前空間を省略できる
グローバルからの絶対指定もできる。
別の名前空間から参照する場合は、常に完全修飾子の指定をする。
これはグローバルに定義されている(組み込みの定義すみ)クラスに対しても同様の事がいえる。
一つのファイルに複数の名前空間を定義する。
namespace Project\Module;
ここはProject\Moduleの中
class Directory {}: Project\Module\Directoryクラス

namespace Project\Module2　Project\Module2　名前空間の中
class Directory {}: Project\Module2\Directoryクラス

namespace Project\Module;
use Project\Module2 as AnotherModule;

$obj = new AnotherModule\SomeClass(); new Project\Module\SomeClass()と等価
グローバルに定義されているクラスなどもインポートすることができる、同様にuseでインポートすることができます。
別の名前空間に定義されたBazクラスを、Bazという名前でアクセスできるようにする。
use Foo\Bar\Baz;
$baz = new Baz();*/

//整数値10で初期化
$a = 10;
//参照代入演算子を使って=& $aの代入を行っている
$b =& $a;
//$aの代入を行うため10という値そのものが$cの持つ新しい領域にコピーされる。
$c = $a;

$a = 20;
echo $b, PHP_EOL;
$c = 10;
echo $c, PHP_EOL;

$ref =& $a;
//参照演算子を使用して代入したら参照先の変数も変更される。
$ref =& $c;
$ref = 30;

echo $c, PHP_EOL;