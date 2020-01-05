<?php

class Router
{
  protected $routes;

  public function __construct($definitions)
  {
    $this->routes = $this->compileRoutes($definitions);
  }

  /*compileRoutes()メソッドでは渡されたルーティング定義配列のそれぞれのキーに含まれる
  動的なパラメータを、正規表現でキャプチャできる形式に変換する。*/
  public function compileRoutes($definitions)
  {
    $routes = array();

    foreach ($definitions as $url => $params) {
      //explode()関数で'/'事に分割する。
      $tokens = explode('/', ltrim($url, '/'));
      foreach ($tokens as $i => $token) {
        //分割した値の中にコロンで始まる文字列があった場合は正規表現の形式に変換する。
        if (0 === strpos($token, ':')) {
          $name = substr($token, 1);
          $token = '(?P<' . $name . '>[^/]+)';
        }
        $tokens[$i] = $token;
      }

      //implode(): 配列要素を文字列により連結する。
      $pattern = '/' . implode('/', $tokens);
      $routes[$pattern] = $params;
    }
    return $routes;
  }

  public function resolve($path_info)
  {
    if ('/' !== substr($path_info, 0, 1)) {
      //PATH_INFOの先頭がスラッシュでない場合、先頭にスラッシュをつける。
      $path_info = '/' . $path_info;
    }

    foreach ($this->routes as $pattern => $params) {
      if (preg_match('#^' . $pattern . '$#', $path_info, $matches)) {
        $params = array_merge($params, $matches);

        return $params;
      }

      //マッチしない場合はfalseを返す。
      return false;
    }


  }
}