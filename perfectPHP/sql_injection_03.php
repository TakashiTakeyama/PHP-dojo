<?php
/**
 * PDOを利用したSQLインジェクションの対策
 */

 function check_user($dbh, $name, $pass) {
   $query = "SELECT * FROM users WHERE name = :name AND pass = :pass";
   //prepare: 実行するステートメントを準備する。
   $sth = $dbh->prepare($query);
   $sth->bindParam(':name', $name, PDO::PARAM_STR);
   $sth->bindParam(':pass', $pass, PDO::PARAM_STR);
   //execute(): プリペアドステートメントを実行する。
   $result = $sth->execute();
   if ($result !== false) {
     $rows = $sth->rowCount();
     if ($rows >= 1) {
       return true;
     }
   }
   return false;
  }

if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
  $conn = pg_connect('host = localhost dbname=perfect '. 'user=user password=password');
  $result = check_user($conn, $_POST['name'], $_POST['pass']);

  if ($result === true) {
    echo '<span style="color: #0000ff">ログインに成功しました</span>';
  } else {
    echo '<span style="color: #ff0000">ログインに失敗しました</span>';
  }
  pg_close($conn);
  exit();
}