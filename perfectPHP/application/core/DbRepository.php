<?php
/*DbRepositoryクラスはへのアクセスを行うクラス、
テーブルごとにDbRepositoryクラスの子クラスを作成するようにする */
abstract class DbRepository
{
  //抽象クラスから継承する際、親クラスの宣言で abstract としてマークされた 全てのメソッドは、子クラスで定義されなければなりません。
  protected $con;

  public function __construct($con)
  {
    $this->setConnection($con);
  }

  public function setConnection($con)
  {
    $this->con = $con;
  }

  public function execute($sql, $params = array())
  {
    $stmt = $this->con->prepare($sql);
    $stmt->execute($params);

    return $stmt;
  }

  //fetch()メソッドは一行のみ取得するメソッド
  public function fetch($sql, $params = array())
  {
    //FETCH_ASSOC定数は取得結果を連想配列で受け取るという指定。
    return $this->execute($sql, $params)->fetch(PDO::FETCH_ASSOC);
  }

  //fetchAll()メソッドは全ての行を取得するメソッド
  public function fetchAll($sql, $params = array())
  {
    return $this->execute($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
  }
}