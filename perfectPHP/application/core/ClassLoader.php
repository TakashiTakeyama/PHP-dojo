<?php
//オートロード: クラスを呼び出した際にそのクラスがPHP上に読み込まれていない場合、自動的にファイルを読み込む事ができるようになる。
/*
①PHPにオートローダクラスを登録する。
②オートロードが実行された際にクラスファイルを読み込む 
クラス名を元に該当するファイルのパスを特定しなくてはならない。
オートロード時の呼び出し処理を簡略化するために、
クラスは「クラス名.php」というファイル名で保存する。
クラスはcoreディレクトリ及びmodelディレクトリに配置する。*/

class ClassLoder
{
  protected $dirs;

  //PHPにオートローダクラスを登録する処理
  public function register()
  {
  //この関数に設定したコールバックが、オートロード時に呼び出されるようになる。
  spl_autoload_register(array($this, 'loadClass'));
  }

  //このメソッドの引数にはロードの対象となるディレクトリへのフルパスを指定する。
  public function registerDir($dir)
  {
    //$dirプロパティに追加される。
    $this->dirs[] = $dir;
  }

  //オートロード時にPHPから自動的に呼び出されて、クラスファイルの読み込みを行う処理
  public function loadClass($class)
  {
    //内部では$dirプロパティに設定されたディレクトリから「クラス名.php」を探してrequireで読み込む
    foreach ($this->dirs as $dir) {
      $file = $dir . '/' . $class . '.php';
      if (is_readable($file)) {
        require $file;

        return;
        //このクラスをオートロードに設定すれば、クラスファイルの読み込みを毎回せずにプログラムを開発して行けるようになる。

      }
    }
  }
}