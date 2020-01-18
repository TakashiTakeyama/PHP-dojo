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
?>