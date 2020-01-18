<?php

//これで中間一致検索になる
$serch_key = '%' . $_POST['serch_key'] . '%';

try {
  $sql = "SELECT * FROM members WHERE last_name like :last_name OR first_name like first_name";
  $stmh = $pdo->prepare($sql);

  $stmh->bindValue(':last_name', $serch_key, PDO::PARAM_STR);
  $stmh->bindValue(':first_name', $serch_key, PDO::PARAM_STR);

  $stmh->excute();
  $count = $stmh->rowCount();
  print "検索結果は" . $count . "件です。<br>";
} catch (PDOException $Exception) {
  print "error: " . $Exception->getMessege();
}
/**
 * 検索条件の%の使い方
 * % 検索キー　前方一致
 * % 検索キー %　中間一致
 * 検索キー %　後方一致
 */