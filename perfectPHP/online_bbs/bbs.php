include 'view/bbs_view.php';
<?php

//データベースに接続
/*mysql_connect()関数でMySQLサーバと接続
第一引数にMySQLサーバのホスト名、第二引数にユーザ名、第三引数にパスワードを指定する。
ここではrootユーザ/パスワードなしで接続している。*/
$link = mysql_connect('localhost', 'root', '');
if (!$link) {
  die('データベースに接続できません: ' . mysql_error());
}

//データベースを選択する
//mysql_select()関数を呼び出してoneline_bbsを選択している。
mysql_select_db('onelie_bbs', $link);

$errors = array();

//POSTなら保存処理実行
//リクエストされたメソッドは$_SERVER['REQUEST_METHOD']に大文字で格納されている。
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //名前が正しく入力されているかチェック
  $name = null;
  //文字列の長さを図るstrlen関数、文字数が0の場合falseを返す。
  if(!isset($_POST['name']) || !strlen($_POST['name'])) {
    $errors['name'] = '名前を入力してください';
  } else if (strlen($_POST['name']) > 40) {
    $errors['name'] = '名前は40文字以内で入力してください';
  } else {
    $name = $_POST['name'];
  }

  //ひとことが正しく入力されているかチェック
  $comment = null;
  if (!isset($_POST['comment']) || !strlen($_POST['comment'])) {
    $errors['comment'] = 'ひとこと入力してください';
  } else if (strlen($_POST['comment']) > 200) {
    $errors['comment'] = 'ひとことは200文字以内で入力してください';
  } else {
    $comment = $_POST['comment'];
  }

  //エラーがなければ保存
  if (count($errors) === 0) {
    //保存するためのSQL文を作成
    /*送信された値をそのままSQL文に指定せず、mysql_real_escape_string()関数に渡した戻り値を
    使用する。SQLインジェクションへの対策、そのままSQL文に使用するとデータベースなどの情報が改竄される
    などの危険性があるため*/
    $sql = "INSERT INTO `post` (`name`, `comment`, `created_at`) VALUES (
      "  . mysql_real_escape_string($name) . "', '"
         . mysql_real_escape_string($comment) . "', '"
         .date('Y-m-d H:i:s') . "')";

    //保存する
    /*SQL文を実行するためにはmysql_query()関数を用いる。
    第一引数にSQL文を、第二引数にmysql_connect()で取得した接続を指定する。 */
    mysql_query($sql, $link);

    mysql_close($link);

    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>ひとこと掲示板</title>
</head>
<body>
  <h1>ひとこと掲示板</h1>

  <form action="bbs.php" method="post">
    <?php if (count($errors)): ?>
      <ul class="error_list">
        <?php foreach ($errors as $error): ?>
          <li>
            <!-- エラーメッセージは直接表示せず、htmlspecialchars()関数に渡してその戻り値を表示している
            これを怠るとクロスサイトスクリプティングなどの様々な脆弱性に繋がってしまう。
            ENT_QUOTESを指定しないとhtmlの特殊文字であるシングルクォーテーションがエスケープされない
            エラーメッセージを変更した際にシングルクォーテーションが含まれる可能性もあるので
            エスケープを行っている。 -->
            <!-- 基本的にエスケープを行い、エスケープを行いたくない場所ではエスケープ処理をしないようにするのが
            セキュアなアプリケーションを作成することに必要になってくる。 -->
            <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
          </li>
        <?php endforeach; ?>
      </ul>
    名前: <input type="text" name="name"><br>
    ひとこと: <input type="text" name="comment" size="60"><br>
    <input type="submit" name="submit" value="送信">
  </form>
  <?php
  //投稿された内容を取得するSQLを作成して結sを取得
  //SELECT文の場合は取得結果を表すresource型の値が返される。
  $sql = "SELECT * FROM `post` ORDER BY `crated_at` DESC";
  $result = mysql_query($sql, $link);
  ?>
  //mysql_num_rows()関数にsqlを渡すことで件数を取得できる。
  <?php if($result !== false && mysql_num_rows($result)): ?>
  <ul>
    <!-- mysql_fetch_assoc()に渡すことで取得結果からレコードを一行分、連想配列として抜き出せる。
    $post変数に代入する。
    mysql_fetch_assoc()は全てを抜き出した後にfalseを返す。
    while文を用いることで1行ずつ取得して処理を行うことができる。 -->
    <?php while ($post = mysql_fetch_assoc($result)): ?>
      <li>
        <!-- htmlspecialcharsでエスケープを必ず行う -->
        <?php echo htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'); ?>:
        <?php echo htmlspecialchars($post['comment'], ENT_QUOTES, 'UTF-8'); ?>
        - <?php echo htmlspecialchars($post['created_'], ENT_QUOTES, 'UTF-8'); ?>
      </li>
    <?php endwhile; ?>
    </ul>
    <?php endif; ?>
    <!-- //保存する -->
    <?php
    //取得結果を開放して接続を閉じる
    mysql_free_result($result);
    mysql_close($link);

    ?>
    <!-- HTTPヘッダ: レスポンスはhtmlを返すだけではない、レスポンスの内容がそもそもhtmlなのか？
    画像なのかといった情報や文字コードの種類、言語、レスポンスのサイズなどがあげられる、
    httpで通信を行う際これらの情報はHTTPレスポンスヘッダと呼ばれるところに格納されている。
    PHPアプリケーションでレスポンスのHTTPレスポンスヘッダに何か情報を追加したい場合は
    header()を使う リダイレクトを行う際にはLocationヘッダを追加する。-->
</body>
</html>

<?php
/*レガシーPHP: HTML中にプログラムを記述できるのはPHPの唯一の特徴である。
改善の仕方 一つのファイルに全ての処理が入っているので単純にファイルを分割する。*/

//取得した結果を$postsに格納
$posts = array();
if ($result !== false && mysql_num_rows($result)) {
  while ($post = mysql_fetch_assoc($result)) {
    $posts[] = $post;
  }
}

//オートロード: クラスを呼び出した際にそのクラスがPHP上に読み込まれていない場合、自動的にファイルを読み込む事ができるようになる。
/*
①PHPにオートローダクラスを登録する。
②オートロードが実行された際にクラスファイルを読み込む 
クラス名を元に該当するファイルのパスを特定しなくてはならない。
オートロード時の呼び出し処理を簡略化するために、
クラスは「クラス名.php」というファイル名で保存する。
クラスはcoreディレクトリ及びmodelディレクトリに配置する。*/
?>