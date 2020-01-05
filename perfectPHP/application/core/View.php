<?php

class View
{
  protected $base_dir;
  protected $defaults;
  protected $layout_variables = array();

  public function __construct($base_dir, $defaults = array())
  {
    //$base_dirプロパティ: ビューファイルを格納しているViewsディレクトリへの絶対パスを指定します。
    $this->base_dir = $base_dir;
    $this->defaults = $defaults;
  }

  public function setLayoutVar($name, $value)
  {
    $this->layout_variables[$name] = $value;
  }

  /*render(): ビューファイルの読み込みを行うメソッド、第一引数はビューファイルへのパス
  第二引数はビューファイルに渡す変数を指定　連想配列で指定
  第三引数はレイアウトファイル名を指定する、レイアウトファイルの指定が必要なのは
  Controllerクラスから呼び出された際のみなので、ここではデフォルト値をfalseにしている */
  public function render($_path, $_variables = array(), $_layout = false)
  {
    $_file = $this->base_dir . '/' . $_path . '.php';

    extract(array_merge($this->defaults, $_variables));

    ob_start();
    ob_implicit_flush(0);

    require $_file;

    //ob_get_crean()メソッドはコールの際バッファ内容の取得と同時にバッファのクリアも行う。
    $content = ob_get_clean();

    if ($_layout) {
      $content = $this->render($_layout,
      array_merge($this->layout_variables, array('_content' => $content,)
    ));
  }

  return $content;
  }

  public function escape($string)
  {
    /*エスケープ: HTML上で特殊文字を期待通りに表示させる事
    HTML特殊文字: &lt;とか */
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
  }
}