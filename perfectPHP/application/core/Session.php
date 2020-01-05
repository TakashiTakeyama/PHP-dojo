<?php

class Session
{
  protected static $sessionStarted = false;
  protected static $sessionIdRegenerated = false;

  public function __construct()
  {
    if (!self::$sessionStarted) {
      session_start();

      self::$sessionStarted = true;
    }
  }

  public function set($name, $value)
  {
    $_SESSION[$name] = $value;
  }

  public function get($name, $default = null)
  {
    if (isset($_SESSION[$name])) {
      return $_SESSION[$name];
    }
    return $default;
  }

  public function remove($name)
  {
    unset($_SESSION[$name]);
  }

  public function clear()
  {
    $_SESSION = array();
  }

  /*セッションIDを新しく発行するためのsession_regenerate_id()関数を実行する
   */
  public function regenerate($destroy =true)
  {
    /*self: そのクラスのプロパティとメソッドに対する静的なアクセス
      this: そのオブジェクト自信を表す。 */
    if (!self::$sessionIdRegenerated) {
      session_regenerate_id($destroy);
      
      self::$sessionIdRegenerated = true;
    }
  }

  //ユーザーがログイン状態を制御するメソッド
  public function setAuthenticated($bool)
  {
    //set()メソッドで連想配列にしている。第二引数は多分データ型
    $this->set('_authenticated', (bool)$bool);

    $this->regenerate();
  }

  public function isAuthenticated()
  {
    return $this->get('_authenticated', false);
  }
}