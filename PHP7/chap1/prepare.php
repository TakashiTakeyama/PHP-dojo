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

$sql = "INSERT INTO sample (last_name, first_name, age) VALUES (:last_name, :first_name, :age)"; 
$sql = "INSERT INTO sample (last_name, first_name, age) VALUES (?, ?, ?)"; 

$stmh = $pdo->prepare($sql);

$stmh->bindValue(':last_name', $_POST['lastname']);
$stmh->bindValue(':first_name', $_POST['firstname']);
$stmh->bindValue(':age', $_POST['age']);
//違うバージョン
$stmh->bindValue(1, $_POST['lastname']);
$stmh->bindValue(2, $_POST['firstname']);
$stmh->bindValue(3, $_POST['age']);


$stml->excute();
  
?>

</body>
</html>