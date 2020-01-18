<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHPのテスト</title>
</head>
<body>
  <?php
  $db_user = "sample";
  $db_pass = "password";
  $db_host = "localhost";
  $db_name = "sampledb";
  $db_type = "myspl";

  $dns = "$db_type:host=$db_host; db_name=$db_name; charset=utf-8";

  try {
    
    $pdo = new PDO($dns, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    print "接続しました。<br>";
  } catch(PDOException $Excepsion) {
    die('エラー:' . $Excepsion->getMessage());
  }
  
  try {
    /**
     * トランザクション内部のSQL文の実行は他のユーザの影響を受けずに実地できる。
     * 例えば複数のユーザーが同時にボタンを押して同じデータを更新したときに最初にボタンを押したユーザの処理ば
     * 他のユーザーの処理をブロックする。
     * さらに一連の処理の中でエラーが出た場合
     * ロールバックして処理を終了してくれる。
     */
    $pdo->beginTransaction();
    //以下はプリペアドステートメント
    $sql = "INSERT INTO members (last_name, first_name, age)
            VALUE (:last_name, :first_name, :age)";

    $stmh = $pdo->prepare($sql);

    $stmh->bindValue(':last_name', $_POST['last_name'], PDO::PARAM_STR);

    $stmh->bindValue(':first_name', $_POST['first_name'], PDO::PARAM_STR);
    $stmh->bindValue(':age', $_POST['age'], PDO::PARAM_INT);
    $pdo->commit();
  } catch(PDOException $Excepsion) {
    $pdo->rollBack();
    print "エラー: " . $Excepsion->getMessage();

  }
  ?>
</body>
</html>