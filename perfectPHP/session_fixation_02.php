<?php

function check_auth() {
  return true;
}

session_start();
header('Content-type: text/html; charset=utf-8');

//ユーザIDがセッション変数に存在すれば、ログインユーザ専用ページを出力
if (isset($_SESSION['user_id']) {
  //ログインユーザ専用ページを表示する
  echo 'ログインユーザ専用ページを表示する<br>';
  echo 'あなたのセッションIDは ' .  session_id() . 'です';
} elseif (
  strtolower($_SERVER['REQUEST_METHOD']) === 'post'
  && isset($_POST['op']) === true
  && $_POST['op'] === 'login'
  && check_auth() === true
) {
  //ログイン処理の実行: 開始
  //ログイン処理の実行: 終了
  $_SESSION['user_id'] = 1;
  session_regenerate_id(true); //セッションIDを再発行
}

/**
 * セッションハイジャック　第三者のセッションをのっとる事で不正な操作を行うのがセッションハイジャック
 * セッションIDは「session.hash_function」「session.hash_bits_per_character」の組み合わせによって
 * 桁数や利用できる文字が変化する。
 * 
 * セッションIDの取得のしかた
 * リファラ: アクセスログに記録されるデータの一つで、ユーザがサイトに流入するときに利用したリンク元のページ情報
 * リファラによるセッションIDの漏洩
 * PHPではクッキーでセッションIDを管理する方法と$_GETと$_POST変数で管理する方法二種類ある。
 * PHPの設定はphp.iniに書いてあるピーエイチーピーイニ
 * ファイルのパスはphp --iniで確認できる。
 * セッションIDはデフォルトではクッキーで管理する事になっている
 * 
 */