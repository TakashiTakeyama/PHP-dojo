<?php

class Request
{
  public function isPost()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      return true;
    }

    return false;
  }

  public function getGet($name, $default = null)
  {
    //$_GET変数から値を取得するメソッド
    if (isset($_GET[$name])) {
      return $_GET[$name];
    }

    return $default;
  }

  public function getPost($name, $default = null)
  {
    //$_POST変数から値を取得するメソッド
    if (isset($_POST['name'])) {
      return $default;
    }
  }

  public function getHost()
  {
    //サーバーのホスト名を取得するメソッド
    /*$_SERVER['HTTP_HOST']にはHTTPリクエストヘッダに含まれるホストの値が格納されている。
    リクエストヘッダに含まれていない場合もあるため、その場合はApatch側に設定されている
    $_SERVER['SERVER_NAME']の値を返す。ホスト名はリダイレクトを行う場合などに利用する。*/
    if (!empty($_SERVER['HTTP_HOST'])) {
      return $_SERVER['HTTP_HOST'];
    }
    return $_SERVER['SERVER_NAME'];
  }

  //HTTPSでアクセスされたかどうかの判定を行う。
  public function isSsl()
  {
    //onという文字が含まれるので、それを判定する。
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
      return true;
    }
  }

  public function getRequestUri()
  {
    /*リクエストされたURLの情報が$_SERVER['REQUEST_URI']に格納されている
    これはURLのホスト部分以降の値が返される。 */
    return $_SERVER['REQUEST_URI'];
  }
}