<?php
// page1.php

session_start();

echo 'Welcome to page #1';

$_SESSION['favcolor'] = 'green';
$_SESSION['animal']   = 'cat';
$_SESSION['time']     = time();

// セッションクッキーが有効なら動作します
echo '<br /><a href="page2.php">page 2</a>';

// あるいは必要に応じてセッション ID を渡します
echo '<br /><a href="page2.php?' . SID . '">page 2</a>';

/**
 * セッションアダプションとは
 * 自身が発行したものではないセッションIDを受け入れ得てセッションが初期化されてしまうという
 * 脆弱性でサンプルのように任意のセッションIDをURLにふよする攻撃や、input要素として
 * 任意のセッションIDを埋め込んだフォームからPOSTさせるなどの攻撃が知られている
 * 
 * またセッションアダプション意外にも「Cookie Monsterバグ」と呼ばれる問題を利用して
 * クッキーに意図するIDを埋め込んでセッション固定攻撃を仕掛ける方法
 * Cookie Monsterバグ
 * ブラウザの不具合を利用して「.co.jp」や「.gr.jp」などのセカンドレベルドメインに対して任意の
 * クッキーをセットする攻撃方法 Cross Domain Cookie Injectionと呼ばれることもある。
 * 古いバージョンのブラウザにはこの脆弱性がある、これを利用してセッション固定攻撃を行う攻撃もある
 * この場合Apatchのアクセスログだけではセッション固定攻撃の痕跡を見つけるのが難しくなる
 */