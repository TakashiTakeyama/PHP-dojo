<?php
/*Applicationクラスはフレームワークの中心となるクラスRequestクラスや
Routerクラス, Responseクラス, Sessionクラスなどのオブジェクト管理を行う他
ルーティングの定義、コントローラーの実行、レスポンスの送信などアプリケーション
全体の流れを司る、アプリケーションの様々なディレクトリのパスの管理も行う
このほかにもデバッグモードで実行できるような機能も持たせる */

abstract class Application
{
  protected $debug = false;
  protected $request;
  protected $response;
  protected $session;
  protected $db_manager;
  protected $login_action = array();

  public function run()
  {
    try {
      // ...
    } catch (HttpNotFoundException $e) {
      $this->render404PFage($e);
    } catch (UnauthorizedActionException $e) {
      list($controller, $action) = $this->login_action;
      $this->runAction($controller, $action);
    }
  }

  public function __construct($debug = false)
  {
    $this->setDebugMode($debug);
    $this->initialize();
    $this->configure();
  }

  /*デバッグモードに応じてエラー表示処理を変更するようにしている。 */
  protected function setDebugMode($debug)
  {
    if ($debug) {
      $this->debug = true;
      ini_set('display_errors', 1);
      error_reporting(-1);
    } else {
      $this->debug = false;
      ini_set('display_errors', 0);
    }
  }

  protected function initialize()
  {
    $this->request = new Request();
    $this->response = new Response();
    $this->session = new Session();
    $this->db_manager = new DbManager();
    //Routerクラスはインスタンスを作成する際にルーティング定義配列を渡すように実装しているため、ルーティング定義配列を
    //返すregisterRoutes()メソッドを呼び出すようにしている
    $this->router = new Router($this->registerRoutes());
  }

  protected function configure()
  {
  }

  abstract public function getRootDir();

  abstract protected function registerRoutes();

  public function isDebugMode()
  {
    return $this->debug;
  }
  
  public function getRequest()
  {
    return $this->request;
  }
  
  public function getResponse()
  {
    return $this->response;
  }

  public function getSession()
  {
    return $this->session;
  }

  public function DbManager()
  {
    return $this->db_manager;
  }

  public function getControllerDir()
  {
    return $this->getRootDir() . '/controllers';
  }
  
  public function getViewDir()
  {
    return $this->getRootDir() . '/views';
  }

  public function getModelDir()
  {
    return $this->getRootDir() . '/models';
  }

  public function getWebDir()
  {
    return $this->getRootDir() . '/web';
  }

  public function run()
  {
    try {
      $params = $this->router->resolve($this->request->getPathInfo());
      if ($params === false) {
        throw new HttpNotFoundException('No route found for' . $this->request->getPathInfo());
      }
  
      $controller = $params['controller'];
      $action = $params['action'];
  
      $this->runAction($controller, $action, $params);
    } catch (HttpNotFoundException $e) {
      $this->render404Page($e);
    }  

    $this->response->send();

  }

  protected function render404Page($e)
  {
    $this->response->setStatusCode(404, 'Not Found');
    $message = $this->isDebugMode() ? $e->getMessage() : 'Page not found.';
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    $this->response->setContent();
  }

  public function runAction($controller_name, $action, $params = array())
  {
    //ucfirst(): 先頭の文字を大文字にする。
    $controller_class = ucfirst($controller_name) . 'Contoroller';

    $controller = $this->findController($controller_class);
    if ($controller === false) {
      throw new HttpNotFoundException($controller_class . 'controller is not found.');
    }

    $content = $controller->run($action, $params);

    $this->response->setContent($content);
  }

  protected function findController($controller_class)
  {
    if (!class_exists($controller_class)) {
      $controller_file = $this->getControllerDir() . '/' . $controller_class . '.php';
      if (!is_readable($controller_file)) {
        return false;
      } else {
        require_once $controlleer_file;

        if (!class_exists($controller_class)) {
          return false;
        }
      }
    }

    return new $controller_class($this);
  }
}