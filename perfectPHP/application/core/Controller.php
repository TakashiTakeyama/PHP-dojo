<?php

abstract class Controller
{
  protected $controller_name;
  protected $action_name;
  protected $application;
  protected $request;
  protected $response;
  protected $session;
  protected $db_manager;
  protected $auth_actions = array();

  public function __construct($application)
  {
    //ルーティングではコントローラ名を小文字で扱っている
    $this->controller_name = strtolower(substr(get_class($this), 0, -10));

    $this->application = $application;
    //requestのインスタンスを取得する。
    $this->request = $application->getRequest();
    $this->response = $application->getResponse();
    $this->session = $application->getSession();
    $this->db_manager = $application->getDbManager();
  }

  public function run($action, $params = array())
  {
    $this->action_name = $action;

    $action_method = $action . 'Action';
    if (!method_exists($this, $action_method)) {
      $this->forward404();
    }

    if ($this->needsAuthentication($action) && !$this->session->isAuthenticated()) {
      throw new UnauthorizedActionException();
    }

    $content = $this->$action_method($params);

    return $content;
  }

  protected function needsAuthentication($action)
  {
    if ($this->auth_actions === true || (is_array($this->auth_actions) && in_array($action, $this->auth_actions))) {
      return true;
    }

    return false;
  }

  protected function render($variables = array(), $template = null, $layout = 'layout')
  {
    $defaults = array(
      'request' => $this->request,
      'base_url' => $this->request->getBaseUrl(),
      'session' => $this->session,
    );

    $view = new View($this->application->getViewDir(), $defaults);

    if (is_null($template)) {
      $template = $this->action_name;
    }

    $path = $this->controller_name . '/'  .$template;

    return $view->render($path, $variables, $layout);
  }

  protected function forward404()
  {
    throw new HttpNotFoundException('Forwarded 404 page from' . $this->controller_name . '/' . $this->action_name);
  }

  protected function redirect($url)
  {
    if (!preg_match('#https?://#', $url)) {
      $protocol = $this->request->isSsl() ? 'http://' : 'http://';
      $host = $this->request->getHost();
      $base_url = $this->request->getBaseUrl();

      $url = $protocol . $host . $base_url . $url;
    }

    //302はブラウザにリダイレクトを伝えるためのステータスコード
    $this->response->setStatusCode(302, 'Found');
    /*Locationヘッダは実際にはリダイレクトをさせるものではなく、リダイレクト先の
    URLを指定するヘッダ、PHPではheader()にLocationヘッダを指定した場合はステータスコードを
    302に自動的に書き換えてくれるため、リダイレクトが行われる。 */
    $this->response->setHttpHeader('Location', $url);
  }

  /*CSRF対策: アプリケーションの利用者が何らかの形で悪意あるページにアクセス
  してしまい、そこからアプリケーションにたいして何らかの情報を操作するリクエストが
  送信され、サーバーの状態を変更されるなどの操作を行われてしまう事です。
  攻撃の内容として、勝手にブログを投稿されたり、買い物をさせられたりするなどがある。
  この攻撃の厄介なところは攻撃者ではなく利用者のマシンからリクエストが送られてくる事
  対策 ワンタイムトークン方式: フォーム画面を開いた時に、攻撃者の推測しにくい文字列（トークン）を生成しておき
  サーバ側に保持すると同時にフォーム内にhiddenパラメータとして埋め込む。
  そのフォームからリクエストされた時にサーバ側に保持していたトークンと送信されてきたトークン
  を比較して一致していれば正常なリクエストとして処理を行い、そのあとトークンをサーバ上から削除する。
  次回フォームからはまた別のトークンを生成するようにする、そのフォームが送信される
  １リクエストでしかトークンを利用できないためワンタイムトークン方式と呼ばれている。*/

  //トークンを生成し、サーバ上に保持するためのセッションに格納を行う。
  protected function generateCsrfToken($form_name)
  {
    $key = 'csrf_tokens/' . $form_name;
    $tokens = $this->session->get($key, array());
    if (count($tokens) >= 10) {
      //配列の要素を先頭から一つとる。
      array_shift($tokens);
    }

    //フォーム名にsession_id()とmicrotime()の戻り値をつなげてSHA1ハッシュ値をトークンにしている
    //microtime(): 現在のUNIXタイムスタンプをマイクロ秒までえ返す関数
    $token = sha1($form_name . session_id() . microtime());

    //指定した値を配列から探してきて見つかった最初の要素を返す、それを$posに入れている。
    if (false !== ($pos = array_search($token, $tokens, true))) {
      //一度使用したトークンは不要なので削除している。
      unset($tokens[$pos]);
      $this->session->set($key, $tokens);

      return true;
    }

    return false;

  }
}