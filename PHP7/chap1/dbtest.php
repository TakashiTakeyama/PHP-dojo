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

try {
  $pdo = new PDO('mysql:host=localhost; dbname=sampledb; charset=utf-8', 'sample', 'password');

  $pdo->setAttribute(PDO::ATTR_ERRMODE,
                     PDO::ERRMODE_EXCEPTION);

  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch (PDOException $exception) {
  die('接続エラー' . $exception->getMessage());

}
?>

</body>
</html>