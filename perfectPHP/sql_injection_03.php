<?php
/**
 * PDOを利用したSQLインジェクションの対策
 */

 function check_user($dbh, $name, $pass) {
   $query = "SELECT * FROM users WHERE name = :name AND pass = :pass";
   $sth = $dbh->prepare($query);
   $sth->bindParam(':name', $name, PDO::PARAM_STR);
   $sth->bindParam(':pass', $pass, PDO::PARAM_STR);
   $result = $sth->execute();
   if ($result !== false) {
     $rows = $sth->rowCount();
     if ($rows >= 1) {
       return true;
     }
   }
   return false;
 }