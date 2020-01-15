<?php

//リンク部分に長いデータを付加して送信するときはGETメソッドを使う
//GETメソッドはURLにキーとデータを付加して送信するので大容量のデータを送るのには向いていない
//また付加したデータがブラウザのアドレスから見えてしまうので秘匿にも向いていない。
/**
 * GETパラメータ: URLの後ろに？以降のkeyとdateの文字=でつなげていく漢字などのマルチバイト文字は使えないためエンコードで変換して使える文字にする。
 * 
 * $name = lowurlencode("永田");
 * 
 * リンク
 * <a href="http://localhost/view.php?onamae=<?=$onamae?>">クリック</a>
 * <?=$onamae?> これは <?php print $onamae; ?> と同義
 * 
 * 
 */

 $array = array("目黒", "渋谷", "恵比寿");
 echo gettype($array) . "\n";

 $result = implode(",", $array);
 //配列要素を文字列により連結する。
 echo $result . "\n";
 echo gettype($result);