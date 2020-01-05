<?php

class DbManager
// <!-- 接続情報を管理する -->
{
  protected $connections = array();
  protected $repository_connection_map = array();
  protected $repositories = array();

  public function get($repository_name)
  {
    if (!isset($this->repositories[$repository_name])) {
      $repository_class = $repository_name . 'Repository';
      $con = $this->getConnectionForRepository($repository_name);

      $repository = new $repository_class($con);

      $this->repositories[$repository_name] = $repository;
    }

    return $this->repositories[$repository_name];
  }

  // <!-- データベースとの接続を開放する処理 -->
  // <!-- __destruct(): インスタンスが破棄された際に実行されるマジックメソッド、インスタンスの破棄は
  // 通常unset()を使った時などに呼ばれる。 -->

  public function __destruct()
  {
    foreach ($this->repositories as $repository) {
      unset($repository);
    }

    foreach ($this->connections as $con) {
      unset($con);
    }
  }

  public function connect($name, $params)
  {
    $params  = array_merge(array(
      'dsn'  => null,
      'user' => '',
      'password' => '',
      'options' => array(),
    ), $params);

    // PDO: データベース抽象化ライブラリ
    // <!-- MySQLやPostgreSQLなどの様々なデータベースに対する操作を同じ記述方法で扱えるようにするためのライブラリ -->
    $con = new PDO(
      $params['dsn'],
      $params['user'],
      $params['password'],
      $params['options'],
    );

    // <!-- これはPDOの内部でエラーが起きた場合に例外を発生させるようにするためのもの -->
    // $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMOD_EXCEPTION);

    $this->connections[$name] = $con;
  }

  public function getConnection($name = null)
  {
    if (is_null($name)) {
      // <!-- current()関数は配列の内部ポインタが示す値を取得する関数 -->
      return current($this->connections);
    }

    return $this->connections[$name];
  }

  public function setRepositoryConnectionMap($repository_name, $name)
  {
    $this->repository_connection_map[$repository_name] = $name;
  }

  public function getConnectionForRepository($repository_name)
  {
    if (isset($this->repository_connection_map[$repository_name])) {
      $name = $this->repository_connection_map[$repository_name];
      $con = $this->getConnection($name);
    } else {
      $con = $this->getConnection();
    }

    return $con;
  }
}

// <!-- DbManagerクラスの使い方
// $db_manager = new DbManager();
// $db_manager->connect('master', array(
//   'dsn' => 'mysql:dbname=mydb; host=localhost',
//   'user' => 'myuser',
//   'password' => 'myapass',
// ));

// $db_manager->getConnection('master');
// $db_manager->getConnection(); -->