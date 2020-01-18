<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <?php

  require_once('MYDB.php');
  db_connect();
  // $id = $_SESSION['id'];
  $id = 1;
  $_SESSION['id'] = $id;

  try {
    $sql = "SELECT * FROM member WHERE id = :id";
    $stmh = $pdo->prepare($sql);
    $stmh->bindValue(':id', $id, PDO::PARAM_INT);
    //excute(): プリペアドステートメントを実行する。
    $stmh->excute();
    $count = $stmh->rowCount();

  } catch(PDOException $Exception) {
    print "error:" . $Exception->getMessage();
  }

  if ($count < 1) {
    print "更新データがありません。";
  } else {

    /**
     * FETCH_ASSOCはカラム名を利用した連想配列が戻り値になるように指定する。
     * ここで結果データを取得、連想配列が戻り値になる。
     */
    $row = $stmh->fetch(PDO::FETCH_ASSOC)
  }





  ?>
  
</body>
</html>