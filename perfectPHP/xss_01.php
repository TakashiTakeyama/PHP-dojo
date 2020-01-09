<?php
/**
 * おみくじの結果をランダムに取得
 * クロスサイトスクリプティングに対する対抗策
 * サイト訪問者に対してJavascriptやVBscriptなどの悪意あるコードを実行させる攻撃方法
 * スクリプト挿入攻撃は攻撃対象のサイトに直接悪意あるコードやメールなどを挿入して攻撃を行うのに対して、
 * クロスサイトスクリプティングは攻撃対象のサイトとは異なるサイトやメールなど間接的な手段を介して行う手法
 * CSSと混同しないようにXSSとしている。
 */

 $fortune = array(
   0 => '大吉',
   1 => '中吉',
   2 => '小吉',
   3 => '末吉',
   4 => '凶',
   5 => '大凶',
 );

 $key = rand(0, 5);
 if (isset($_GET['username'])) {
   //ここできちんとエスケープする
   echo htmlspecialchars($_GET['username'], ENT_QUOTES, 'UTF-8') . "さんの運勢は" . $fortune[$key] . "です。";
 }

 //おみくじフォームを出力
 echo '<form action="">';
 echo 'お名前<input type="text" name="user_name">';
 echo '<input type="submit" value="占ってみる">';
 echo '</form>';