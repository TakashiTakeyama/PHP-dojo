<?php

//接頭子にデータベースの種類を書く
$pdo = new PDO('mysql:host=localhost;dbname=sampledb;cherset=utf-8','sample','password');

print "PDOクラスによる接続に成功しましたしました。";

//ここで切断
$pdo = null;

//PDOクラスで生成されたオブジェクトをデータベースハンドラという。
//ハンドラ: 普段は待機していて必要な時だけ起動するプログラム
//setAttributeで属性を指定できる。
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//第一引数: エラー属性 第二引数: 属性値ちなみに例外を投げるという意味
//PDO::ATTR_EMULATE_PREPARESを設定しfalseにすることでプリペアドステートメントを利用できる。
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

try {
  //処理1;
  throw new Exception('例外が発生しました。');
} catch(Exception $e) {
  //処理2; 
} finally {
  //エラーが発生したかどうかに関わらず実行される。
}

/**
 * リペアドステートメントを使うときは二種類の書き方がある
 * VALUEのカラムの前に:コロンをつける
 * ?を書くのどちらか
*/
$sql = "INSERT INTO sample (last_name, first_name, age) VALUES (:last_name, :first_name, :age)"; 
$sql = "INSERT INTO sample (last_name, first_name, age) VALUES (?,?,?)"; 