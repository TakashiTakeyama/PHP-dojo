<?php

$pdo = new PDO("mysql:host=localhost; dbname=mydb: charset=utf8", 'user', 'f3u6mi');

function db_connect() {
  $dns = "mysql:host=localhost; db_name=mydb; charset=utf8";
  $pdo = new PDO($dns, 'user', 'f3u6mi');

};

$sql = "INSERT INTO members (last_name, first_name, age)
             VALUES (:last_name, :first_name, age)";

$smth = $pdo->prepare($sql);
$smth->bindValue(':last_name', $_POST['last_name']);
$smth->bindValue(':first_name', $_POST['first_name']);
$smth->bindValue(':age', $_POST['age']);