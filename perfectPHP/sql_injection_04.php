<?php
/**
 * 入力されたユーザ名とパスワードを元に、ユーザが存在するか確認する。
 */

 function check_user($conn, $name, $pass) {
   $name = pg_escape_string($name);
   $pass = pg_escape_string($pass);
   $query = "SELECT * FROM users WHERE name = '$name' AND pass = '$pass'";
   $result = pg_query($conn, $query);
   //クエリの戻り値がfalseでなければ、クエリ実行自体は正常
   if ($result !== false) {
     //取得したレコード数が1以上ならログイン成功
      $rows = pg_num_rows($result);
      if ($rows >= 1) {
        return true;
      }
   }
   return false;
 }

 AllOverrid