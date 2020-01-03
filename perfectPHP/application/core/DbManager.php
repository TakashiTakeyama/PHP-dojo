class DbManager
{
  protected $connections = array();

  public function connect($name, $params)
  {
    $params  = array_merge(array(
      'dsn'  => null,
      'user' => '',
      'password' => '',
      'options' => array(),
    ), $params);

    PDO: データベース抽象化ライブラリ
    <!-- MySQLやPostgreSQLなどの様々なデータベースに対する操作を同じ記述方法で扱えるようにするためのライブラリ -->
    $con = new PDO(
      $params['dsn'],
      $params['user'],
      $params['password'],
      $params['options'],
    );

    <!-- これはPDOの内部でエラーが起きた場合に例外を発生させるようにするためのもの -->
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMOD_EXCEPTION);

    $this->connections[$name] = $con;
  }

  public function getConnection($name = null)
  {
    if (is_null($name)) {
      <!-- current()関数は配列の内部ポインタが示す値を取得する関数 -->
      return current($this->connections);
    }

    return $this->connections[$name];
  }
}