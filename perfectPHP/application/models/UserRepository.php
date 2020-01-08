<?php

class UserRepository extends DbRepository
{
  public function insert($user_name, $password)
  {
    $password = $this->hashPassword($password);
    $now = new DateTime();

    $sql = "
        INSERT INTO user (user_name, password, created_at)
        VALUES (:user_name, :password, :created_at)";

        //excute(): プリペアドステートメントを実行する
    $stml = $this->execute($sql, array(
      ':user_name' => $user_name,
      ':password' => $password,
      ':created_at' => $now->format('Y-m-d H:i:s'),
    ));
  }

  public function hashPassword($password)
  {
    //sha1(): ハッシュ化を行う
    return sha1($password . 'SecretKey');
  }

  public function fetchByUserName($user_name)
  //ユーザーIDを元にレコードを取得する。ユーザーIDは引数として受け取る。
  {
    $sql = "SELECT * FROM user WHERE user_name = :user_name";

    return $this->fetch($sql, array(':user_name' => $user_name));
  }

  public function isUniqueUserName($user_name)
  {
    /*プリペアドステートメント: SQL文を最初に用意しておいて、そのあとはクエリ内のパラメータの値だけを変更して
    クエリを実行できる環境の事、この機能を利用する事でクエリの解析やコンパイル等にかかる時間は
    最初の一回だけでよくなりより高速に実行することができる */
    $sql = "SELECT COUNT(id) as count FROM user WHERE user_name = :user_name";

    $row = $this->fetch($sql, array(':user_name' => $user_name));
    //SQLの実行結果は文字列型なので、文字列の'0'と比較する。
    if ($row['count'] === '0') {
      return true;
    }

    return false;
  }
}