<?php
/**
 * 正規のユーザに対して意図しない動作を行わせるのがクロスサイトリクエスト
 * フォージュエリです。
 * ユーザーが意図しない投稿や削除、購入などの被害が起こる危険性があるため、正しく理解して行う必要がある。
 * 対策としてワンタイムートークンによるチェックを行う
 * 投稿、削除、編集などを行うときはパスワード認証を行う
 * 
 */

 function is_admin() {
   if (isset($_SESSION['is_admin']) === true
   && $_SESSION['is_admin'] === true) {
     $is_admin = true;
   } else {
     $is_admin = false;
   }
   return $is_admin;
 }

 /**
  * ワンタイムトークンを生成する関数
  */
function get_token($key = '')
{
  $_SESSION['key'] = $key;
  $token = sha1($key);
  return $token;
}

/**
 * ワンタイムトークンをチェックする関数
 */

 function check_token($token = '') {
   return ($token === sha1($_SESSION['key']));
 }

 //ワンタイムトークン生成用文字列
 $seed = 'secret';

 //セッション開始
 session_start();

 //POSTだった場合は、指定された処理を実行
 if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
   //管理者かチェック
   if (isset($_POST['op']) === true
   && $_POST['op'] === 'delete'
   && is_admin() === true
  ) {
    //管理者ならワンタイムトークンを確認
    if (isset($_POST['token']) === false
    || check_token($_POST['token']) === false
    ) {
      //ワンタイムトークン不正のため削除は行わない
      echo 'CSRF攻撃を受けた可能性があります';
    } else {
      //ワンタイムトークンが問題なければ削除処理を行う
      echo '記事の削除を行いました';
      //セッションないのワンタイムトークンを削除する
      unset($_SESSION['key']);
    }
    
   //管理者ならば削除依頼を行う
   echo '記事の削除を行いました';
 } elseif (isset($_POST['op']) === true
   && $_POST['op'] === 'login'
   ) {
      //ログイン処理を実行
      $_SESSION['is_admin'] = true;
      echo '管理者としてログインしました';
   } else {
     //管理者意外なのでエラー表示
     echo '権限がありません';
   }
 }
  