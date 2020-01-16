<?php

//リンク部分に長いデータを付加して送信するときはGETメソッドを使う
//GETメソッドはURLにキーとデータを付加して送信するので大容量のデータを送るのには向いていない
//また付加したデータがブラウザのアドレスから見えてしまうので秘匿にも向いていない。
/**
 * GETパラメータ: URLの後ろに？以降のkeyとdateの文字=でつなげていく漢字などのマルチバイト文字は使えないためエンコードで変換して使える文字にする。
 * 
 * $name = lowurlencode("永田");
 * 
 * リンク
 * <a href="http://localhost/view.php?onamae=<?=$onamae?>">クリック</a>
 * <?=$onamae?> これは <?php print $onamae; ?> と同義
 * 
 * 
 */

 $array = array("目黒", "渋谷", "恵比寿");
 echo gettype($array) . "\n";

 $result = implode(",", $array);
 //配列要素を文字列により連結する。
 echo $result . "\n";
 echo gettype($result);

 /**
  * setcookie(): ("キー", "値", "cookieの有効期限");
  * 例 setcooie("count", $count, time() + 10);
  * セッションIDはcookieに保存される。
  */

  /**
   * PHPでは session_start()で宣言すれば自動的にsession管理してくれる
   * $_SESSION["キー"] = "値";
   * unset($_SESSION["キー"]);
   * $_SESSION = []; session変数を全て削除
 * session_cashe_expier(60); 有効期限を設定
 * session_destroy sessionを破棄する
 * セッションの情報はサーバーのハードディスク内またはメモリ内にセッションID事に保管されている
 * この情報にアクセスするにはユーザーの身分証明の為のセッションIDが一致する必要がある
 * cookie内にセッションIDがあるのでsessionが有効なうちはdateを取り出すことができる
 * 会員制のシステムではログアウトや退会処理の後にsession変数を全て削除する
 * つまりセッション変数の削除、クッキーないのセッションIDの削除、サーバー側のセッション情報の削除と一連の削除を行う必要がある。
 * まずセッション変数を削除(ユーザの情報)
 * $_SESSION = array();
 * 次にクッキーないのセッションIDを削除
 * session_destroy()
 * クッキーの削除のしかた
 * ini_get("session.use_cookies")でクッキーの使用の有無を確認
 * 使用している場合session_get_cookie_params関数で現在の設定を$paramsに取り出す
 * if(ini_get(session.use_cookies)) {
 * $params = session_get_cookie_params();
 * setcookie(sesson_name(), ",time() - 42000,
 * $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
 * 
 * ファイルの移動
 * move_upload_file(一時ファイル名, 移動先ファイル名)
 * MIME(マイム): TCP/IPで上でやりとりする電子メールで当初の規格より唯一記載することができたASCII英数字以外のデータ（各国語の文字、添付ファイルなど）を取り扱うことができるようにする拡張仕様。
 * MIMEタイプ: Webの世界では拡張子という概念と、もうひとつ『MIMEタイプ』という概念があります。MIMEタイプとは「タイプ名/サブタイプ名」の形式の文字列で、WEBサーバーとWEBブラウザの間はこのMIMEタイプを用いてデータの形式を指定しています。例えばMIMEタイプには以下のようなものがあります。
 * 画像ファリルのチェック
 * finfo()を使う MIMEタイプを確認するメソッド
 * 
 * PHPで画像を操作するにはGDを使う必要があるが標準インストールされている。
 * IPアドレスとポートを合わせたものをソケットとよび実際のデータのやりとりはソケット単位で行われる
 * <?php
 * 
 * backtick演算子: この関数は``で囲ったリテラルをそのまま変数に入れて実行することができる
 * 例 $ls = `/bin/ls -l/etc`;
 * print $ls; 
 * 
 * $commands = `ls -a`;
 * 
 * $_POST["address"];
 * session_start();
 * 
 * $_SESSION['name'];
 * オブジェクトを定義した後にクラスに分けることを抽象化という
 * 例えばがkklうに例えると生徒がオブジェクトだとする、沢山の生徒をクラスという概念で分けることを抽象化という。
 * 
 */

 class loft {

   public $like = "uketuke";

   function i_like_you($feeling) {

   }
 }
 //クラスに分けることを抽象化するということそれを実体化することがインスタンス化することである。
 //protected 定義したクラス内と継承されたクラス内でのみ使用できる
 /**
  * PHPのクラスの継承は一つだけであるがトレイトを使うといくつものメソッドやメンバ変数(プロパティ)を追加することができる。
  * ジョイフィット会員
  */

  /**
   * trail でクラスのように定義してクラス内でuseでtraitを呼び出す。
   * アクセサ: オブジェクト指向で外部からクラス内のメンバ変数にアクセスする為のメソッド、メンバ変数をオブジェクト内部に隠蔽し、外部から直接参照させないようにする為
   * 
   * デザインパターン: オブジェクト指向言語でよく使われる設計をパターン化したもの。
   */

 class Members implements IteratorAggregate {
   private $members = [];

   public function add (Member $member) {
     $this->members[] = $member;  
   }

   public function getIterator()
   {
     return new ArrayIterator($this->members);
   }
 }
