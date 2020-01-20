<?php
function db_connect() {
  $db_user = "sample";
  $db_pass = "password";
  $db_host = "localhost";
  $db_name = "sampledb";
  $db_type = "mysql";

  $dns = "$db_type:host=$db_host; db_name=$db_name; charset=utf8";

  try {
    
    $pdo = new PDO($dns, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    print "接続しました。<br>";
  } catch(PDOException $Excepsion) {
    die('エラー:' . $Excepsion->getMessage());
  }
  return $pdo;
}

/**
 * host名: ネットワークに繋いだコンピュータを識別する名前
 * ネットワーク上ではつけた名前で識別することができる。
 * 例: http://ぴよ太/
 * localhost: 自分自身を表す。
 * 
 * 正規化とは
 * テーブルに格納するデータを決めるときにデータの正規化を行う必要がある
 * 一件のレコードの中に同じカラム（フィールド）のデータが含まれないように構造を決定することです。
 * 合わせて適切なテーブル定義を行い、記憶容量やプログラミングの効率を考える必要がある。
 * 
 * DROP TABLE IF EXISTS member
 * 
 */

?>