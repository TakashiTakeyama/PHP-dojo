<?php
/**
 * セッション固定攻撃
 * 攻撃対象のユーザに対して任意のセッションIDを強制的に利用させる攻撃
 */

/**
 * 認証用の関数
 * ダミーなので常にtrueを返しています。
 */

 function check_auth() {
   return true;
 }

 session_start();
 header('Content-type: text/html; charset=utf-8');

 //ユーザーIDがセッション変数に存在すれば、ログインユーザ専用ページを出力
 if (isset($_SESSION['user_id'])) {
   // ログインユーザー専用ページを表示する
   echo 'ログインユーザ専用ページです<br>';
   echo 'あなたのセッションIDは' . session_id() . 'です'; //脆弱性の確認用

 } elseif (
   strtolower($_SERVER['REQUEST_METHOD']) === 'post'
   && isset($_POST['op']) === true
   && $_POST['op'] === 'login'
   && check_auth() === true
   ) {
     //ログイン処理の実行: 開始
     // ...
     //ログイン処理の実行: 終了
     $_SESSION['user_id'] = 1; //ダミーのユーザIDをセッションに格納
     //ログイン成功画面を出力
     $script = basename($_SERVER['SCRIPT_FILENAME']);
   }