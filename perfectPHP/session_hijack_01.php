<?php

session_start();

//セッション変数内のカウントが未設定の場合は0を設定
if (isset($_SESSION['count']) !== true) {
  $_SESSION['count'] = 0;
}

//出力するメッセージをセット
if (isset($_GET['keyword']) === true && $_GET['keyword'] !== '') {
  $_SESSION['count'] ++ ;
  $message = 'あなたが入力したキーワードは[' . $_GET['keyword'] . ']です。<br>';
} else {
  $message = 'あなたがキーワードを入力したのは' . $_SESSION['count'] . '回目です。';

}

/**
 * セッションハイジャックの対応策
 * XSSやセッション固定攻撃に対する対応対策を行った上で、次のような
 * 対応を行う必要がある
 * セッションIDをクッキーのみで扱う
 * セッションハイジャックのチェック
 * パスワード入力による多重チェックの実装
 * 
 * セッションIDをクッキーのみで行うにはphp.iniや.htaccess, ini_set()関数でセッションに
 * 関する値を以下のようにする
 * session.use_cookies = 1
 * session_only_cookies = 1
 * session.user_trans_sid = 0
 */