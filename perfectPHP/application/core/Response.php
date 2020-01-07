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
    //HTTPプロトコルのバージョンを指定するもの。
    //"HTTP/1.1 200 OK";
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

CREATE DATABASE `mini_blog` DEFAULT CHARACTER SET utf8;

CREATE TABLE user(
  id INTEGER AUTO_INCREMENT,
  user_name VARCHAR(20) NOT NULL,
  password VARCHAR(40) NOT NULL,
  created_at DATETIME,
  PRIMARY KEY(id),
  UNIQUE KEY user_name_index(user_name)
) ENGINE = INNODB;

CREATE TABLE following(
  user_id INTEGER,
  following_id INTEGER,
  PRIMARY KEY(user_id, following_id)
) ENGINE = INNODB;

CREATE TABLE status(
  id INTEGER AUTO_INCREMENT,
  user_id INTEGER NOT NULL,
  body VARCHAR(255),
  created_at DATETIME,
  PRIMARY KEY(id),
  INDEX user_id_index(user_id)
) ENGINE = INNODB;

ALTER TABLE following ADD FOREIGN KEY (user_id) REFERENCES user(id);
ALTER TABLE following ADD FOREIGN KEY (following_id) REFERENCES user(id);
ALTER TABLE status ADD FOREIGN KEY (user_id) REFERENCES user(id);
