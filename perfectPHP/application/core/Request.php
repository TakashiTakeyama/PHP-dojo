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

  public function getBaseUrl()
  {
    $script_name = $_SERVER['SCRIPT_NAME'];

    $request_url = $this->getRequestUri();
   

    /*strpos: 第一引数に指定した文字列から、第二引数に指定した文字列が最初に出現する位置を
    調べる関数。 
    REQUEST_URIはそのまま、【ブラウザから送られてきた要求のURI】
    SCRIPT＿NAMEは【実行されているスクリプトのパス】*/
    if (0 === strpos($request_url, $script_name)) {
      return rtrim(dirname($script_name), '/');
    }

    return '';
  }

  public function getPathInfo()
  {
    $base_url = $this->getBaseUrl();
    $request_uri = $this->getRequestUri();

    if (false !== ($pos = strpos($request_uri,'?'))) {
      /*substr()関数は、第一引数で指定した文字列のうち、第二引数で指定した位置から
      第三引数で指定した文字数分取得する関数
      URLにGETパラメータを含む場合はREQUEST_URIに"?"が含まれているので
      strpos()関数で判定を行い、substr()関数で"?"より前の箇所を抜き出している。*/
      $request_uri = substr($request_uri,0,$pos);
    }

    //strlen: 文字列の長さをえる。
    $path_info = (string)substr($request_uri, strlen($base_url));

    return $path_info;
  }

  /*PHPで正規表現によるマッチングを行うにはpreg_match()関数を使う。
  preg_match(): 第三引数に変数を指定すると、キャプチャした値を取得することができる。
  $pattern = '/ab(cd)ef/';
  $string = 'abcdefghij';
  preg_match($pattern, $string, $matches);

  $pattern = '/ab(?P<foo>cd)ef/';
  $string = 'abcdefghij';
  preg_match($pattern, $string, $matches);
  var_dump($matches);
  */
}