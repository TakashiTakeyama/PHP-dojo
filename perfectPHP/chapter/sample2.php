<?php

// $arr = get_defined_functions();
// print_r($arr);
/*php5以降で本格的なオブジェクトの機能が備わった。
クラスも関数と同様に、名前空間を使わない限り、グローバルに定義される
定義済のクラスとの名前の衝突問題が起こる、この問題は
関数と同様に名前空間に相当するものをアンダースコアで区切ってクラス名をつける事で対応する。
クラス名はアッパーキャメル*/
class Employee
{
  /*アクセス修飾子publicはどこからでもアクセス可能
  protected: そのクラス自身と継承クラスよりアクセスする事ができる。
  private: 同じクラス内でのみアクセス可能です。*/

  public function work()
  {
    echo '書類を整理しております', PHP_EOL; 
  }
}

$yamada = new Employee;
// var_dump($yamada);
$yamada->work();
/*参照渡しをしなくても同じオブジェクトオブジェクト

