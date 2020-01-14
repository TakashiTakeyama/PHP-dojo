<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<?php
  echo __DIR__;
  print PHP_OS;
  $name = [
    'name' => 'takashi',
    'age' => 35,
    'address' => '東京',
  ];

  // echo $name['name'];
  // echo $name[1];
  //多次元配列配列の中に配列　PHPでは配列、連想配列の中に全てのデータ型を入れることができる
  //参照のしかた例 $name[0][1];
  $str = '';
  $array = array_keys($name);
  var_dump($array);
  $sum = 5 + 1;
  print "5 + 1 + $sum";
  print 5 + 1 + $sum;
  $str .= "文字列を代入する代入演算子";

  /**
   * ビット演算子　ビット単位でデータをやりとりするPHPのWebアプリケーションではほとんど使われない
   * 
   * Null合体演算子
   * 三項演算子で書かれていた物を分かりやすくするためにphp7で導入された
   *
   * NULL合体演算子
   * $user_age = $get_age ?? '年齢不詳';
   * 三項演算子
   * $user_age = isset($get_age) $get_age : '年齢不詳';
   * こんな書き方もある
   * $cond===true ? func1() : func2();
   * 
  */
  $count = 0;
  print $count++; //ここで0を表示する。
  print $count; //ここで1になる。
  //条件分岐が複雑になる場合は見通しが良くなるためSwitch文を使う
  //ディレクトリハンドル: 当該ディレクトリ内のファイルアクセス位置の事

//while文はデータ数がわからない時に使うと良い
//ディレクトリハンドルからエントリを読み込む
  // if ($dirhandle = opendir('.')) {
  //   while (false !== ($dirname = readdir($dirhandle)))
  //   {
  //     print $filename . "<br>";
  
  //   closedir($dirhandle);
  //   }
  // }

  $member = array("name" => "takashi",
                  "age" => 35,
                  "tall" => 182);

  foreach($member as $key => $val) {
    echo "$key : $val"; 
    print "<br>";
  }

  /**
   * PHP7では配列内のポインタは使用しない。
   * その一方でwhileやlistやeachで処理すると配列内のデータを指し示すポインタが移動するため
   * reset文で配列のポインタを先頭に戻す
   * 
   * set_include_path(): include_path設定オプションを設定する
   * 
   * includeとrequireの違い: error時の振る舞いが違うだけ
   * includeはWarningが出て処理は実行されるが、
   * requireはFatalになり処理が終了される
   *    
   * 
   * function check_user_name($user_name = default, $pass = default) {
   *    if ($user_name == "geust" && $pass == "pass")
   *       {
   *          print "こんにちはgeuestさん";
   * }else {
   *          print "こんにちは会員さん"} 
   * }
   * 
   * 引数のdefault値の順番
   * function check_member($user_name = default, $password) {
   * //これは動作しない　}
   * funciton check_member($user_name, $password = guest) {
   * //これは動作する   }
   * つまりデフォルト値を設定する引数は右側に、しない引数は左側に書く
   * 
   * 返り値 return文では複数の値を返すことはできないので配列にして返す
   * 
   * list = ($year, $month, $day) = get_today();
   * 
   * print $year . '年' . $month . '月' . $day . '日';
   * 
   * function get_today()
   * {
   *  $year = date('Y');
   *  $month = date('m');
   *  $day = date('d');
   * returnで配列を返す。
   *  return array($year, $month, $day);
   * 
   * }  
   * スーパーグローバル変数: 全て連想配列として扱う
   * 関数内で$GROBALS['data']
   * 
   * 
   * htmlspecialchars(文字列, オプション)
   * htmlタグをエスケープする
   * strip_tags(文字列, 許可するタグ)
   * 
   * 文字入力の途中でenterやReturnをキーを押すと改行され文字列の中に改行コードが入る
   **/

/**
 * 配列の作成
 * インデックスを省略して作成
 * $array = [];
 * $array = "文字列 0";
 * $array = "文字列 1";
 * $array = "文字列 2";
 * $array = "文字列 3";
 */

?>
  
</body>
</html>