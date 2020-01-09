<?php
/**
 * SQLインジェクション:  DBに対する意図しない命令文を挿入することでデータを改竄したり
 * 盗み出したりする手法
 * 対策法としてはプリペアドステートメントを用意する
 * 予めプレースホルダーを含んだSQLを事前に準備することで
 * プログラム側でエスケープを行う必要がなくなる。
 * PHPでプリペアドステートメントを利用する場合PHP Data Objects(PDO)
 * がバージョンが5.1.0より新しいバージョンであれば PDOがデフォルトで有効となっている
 */

/**
 * 入力されたユーザー名とパスワードを元に、ユーザが存在するか確認する
 * SELECT * FROM tb2 WHERE ban=1;delete from tb2
 * セミコロンで区切られているがこれを複文という
 */

 function cehck_user($name, $pass) {
   $query = "SELECT * FROM users WHERE name = '$name' AND pass = '$pass'";
   $result = mysqli::query($query);
   //クエリ実行の戻り値がfalse出なければ、クエリ実行自体は正常
   if ($result !== false) {
     //取得したレコード数が1以上ならログイン成功
     $rows = mysql_num_rows($result);
     if ($rows >= 1) {
       return true;
     }
   }

   return false;
 }

 //POSTの場合はログインチェク
 if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
   $conn = mysql_connect('localhost', 'root', '');
   $mysql_select_db('perfect');
   $result = check_user($_POST['name'], $_POST['pass']);
   if ($result === true) {
     echo '<span style="color: #0000ff">ログインに成功しました</span>';
    } else {
      echo '<span style="color: #ff0000">ログインに失敗しました</span>';
    }
    mysql_close($conn);
    exit();
 }