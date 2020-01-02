<?php

class Response
{
  /*HTTPヘッダを送信するためのheader()関数がPHPには実装されており
  好きなところからHTTPヘッダの送信が可能 */
  protected $content;
  protected $status_code = 200;
  protected $status_text = 'OK';
  protected $http_headers = array();

  public function send()
  {
    header('HTTP/1.1' . $this->status_code . ' ' . $this->status_text);

    foreach ($this->http_headers as $name => $value) {
      header($name . ': ' . $value);
    }

    echo $this->content;
  }
  
  //HTMLなどの実際にクライアントに返す内容を格納する。
  public function setContent($content)
  {
    $this->content = $content;
  }

  public function setStatusCode($status_code, $status_text = '')
  {
    $this->status_code = $status_code;
    $this->status_text = $status_text;
  }

  public function setHttpHeader($name, $value)
  {
    //$http_headersプロパティにはHTTPヘッダを格納するプロパティ、連想配列形式で格納する。
    $this->http_header[$name] = $value;
  }
}