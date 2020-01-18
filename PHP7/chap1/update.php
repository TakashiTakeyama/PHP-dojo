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
  try {
    db_connect();
  } catch (Exception $e) {
    echo $e->getMessage();
  }

  $id = $_SESSION['id'];

  try {
    $pdo->beginTransaction();
    $sql = "UPDATE member 
            SET last_name = :last_name,
                first_name = :first_name,
                age = :age
            WEHER id = :id";

    $stmh->prepare($sql);
    $stmh->bindValue(':last_name', $_POST['last_name'],PDO::PARAM_STR);
  } catch(PDOException $Exception) {
    $error_message = $Exception->getMessage();
    print $error . "のため更新できませんでした。";
  }

  ?>
  
</body>
</html>