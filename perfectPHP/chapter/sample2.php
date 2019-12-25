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
}
