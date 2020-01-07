<?php

class MiniBlogApplication extends Application
{
  protected $login_action = array('account', 'signin');

  public function getRootDir()
  //ルートディレクトリへのパスを返すメソッド
  {
    return dirname(__FILE__);
  }

  protected function registerRoutes()
  //ルーティング定義配列を返すメソッド
  {
    //MiniBlogApplication::registerRoutes()
    return array(
      '/account'
        =>array('controller' => 'account', 'action' => 'index'),
      '/account/:action'
        => array('controller' => 'account'),
    );
  }

  protected function configure()
  //アプリケーションの設定を行うメソッド
  {
    $this->db_manager->connect('master', array(
      'dsn' => 'mysql:dbname=minii_blog;host=localhost',
      'user' => 'root',
      'password' => '',
    ));
  }

}