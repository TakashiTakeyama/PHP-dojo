<?php

echo 'hello from the TOP!';
echo 'hello from the TOP! again!';

 ?>

 <!-- <!DOCTYPE>
 <html lang="ja">
   <body>
     <p>Hello World <?php echo 'from PHP'; ?></P>
   <body>
 </html> -->

<!-- $msg = "hello from the TOP";
echo $msg;
var_dump($msg);

define("MY_EMAIL", "taguchi@dotinstall.com")

echo MY_EMAIL = "hogehoge";

var_dump(__LINE__);
var_dump(__FILE__);
var_dump(__DIR__);

$x = 10 % 3;
$y = 30.2 / 4; 
var_dump($x);
var_dump($y);

$z = 5;
$z =++;
$z =--;

$x = $x + 2;
$x += 2; -->

$name = "taguchi";
$s1 = "hello $name!\nhello again!";
$s2 = "hello $name!\nhello again!";

var_dump($s1);

$s = "hello" . "world";
var_dump($s);

$score = 85;

if ($score > 85) {
  echo "great!"
} else if ($score > 65) {
  echo "good!";
} else {
  echo "so so...";
}

$x = 5;
if ($x) {
  echo "great";
}

$max = ($a > $b) ? $a : $b

$signal = "red";

switch ($signal) {
  case "red":
    echo "stop!";
    break;
  case "bule":
  case "green":
    echo "go!";
    break;
  case "yellow":
    echo "caution!";
    break;
  default:
    echo "wrong signal";
    break;

$i = 0;
while ($i < 10) {
  echo $i;
  i++;
}

do {
  echo $i;
  $i++;
} while ($i < 10);

for ($i = 0; $i < 10; $i++ ) {
  ehco $i;
}

for ($i = 0; $i < 10; $i++ ){
  if ($i === 5) {
    ehco $i;
    cnotinue;
  }
  echo $i;
}

$sales = array(
  "taguchi" => 200,
  "fkoji" => 800,
  "dotinstall" => 600
)

$sales = [
  "taguchi" => 200,
  "fkoji" => 800,
  "dotinstall" => 600,
  ];

var_dump($sales["fkoji"]);
$sales["fkoji"] = 500;

$colors = ["red", "blue", "pink"];
var_dump($colors[1]);

foreach($sales as key => $value) {
  echo "($key) $value ";
}

foreach ($colors as $value) {
  echo "$value";
}
// foreach if while for コロン構文
foreach ($colors as $value) :
  echo "$value";
endforeach;

?>
<ul>
  <?php foreach ($colors as $value) : ?>
  <li><?php echo "$value "; ?></li>
  <?php endforeach; ?>
</ul>

<?php

// function sayHi()
// {
//     echo 'Hi';
// }

// sayHi();

function sayHi($name = 'taguchi')
{
    $lang = 'php';
    echo 'hi!'.$name;

    return 'hi!'.$name;
}

sayHi('Tom');
sayHi('Bob');
sayHi();

echo ceil($x);
echo floor($x);
echo round($x);
echo rand(1, 10);

$s1 = "hello",
$s2 = "ねこ"

$colors = ["red", "blue", "pink"];
echo count($colors)
echo.iplode("@", $colors);

//User

class User {
  //property
  public $name;
  public static $count = 0;
  self::$count++;

  public function __constructor($name) {
    $this->name = $name;
  }

  final public function sayHi() {
    echo "hi, i am $this->name!";
  }

  $tom = new User("Tom");
  $bob = new User("Bob");

  echo $tom->name;
  $bob->sayHi();
}

class AdominUser extends User {
  public function sayHello() {
    echo "hello from Adomin!";
  }
  //overrride
  public function sayHi() {
  echo " [admin] hi, i am $this->name!";
  }

  public static function getMessage() {
    echo "hello from User class!";
  }

  public static $count = 0;
}

User::getMessage();

$steve = new AdminUser("Steve");
echo $steve->name;
$steve->sayHi();
$tom->sayHi();
$steve->sayHello();

//static

//抽象クラス　他のクラスで継承してもらうことを前提としたクラス

abstract class BaseUser {
  public $name;
  abstract public function sayHi();
}

class User extends BaseUser {
  public function sayHi() {
    ecno "hello from User";
  }
}

//interface

interface sayHi {
  public function sayHi();
}

interface  sayHello {
  public fuction sayHello();
}

class User implements sayHi, sayHello {
  public function sayHi(){
    echo "hi";
  }

  public function sayHello() {
    echo "hello!";
  }
 }

 require "User.class.php";

 spl_autload_register(function($class) {
   require $class . ".class.php";
 };

 <?php
// namespace Dotinstall\Lib;

$bob = new Dotinstall\Lib\User("Bob");

//例外処理

function div($a, $b) {
  echo $a / $b;
}

function div($a, $b) {
  echo $a / $b;
  try {
    if ($b === 0) {
      throw new Exception("cannot divide by 0!");
    }
    echo $a / $b;
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}

<!DOCTYPE html>
<html lang="ja">
<head>
<meta chraset="utf-8">
<title>Check username</title>
</head>

<body>
<form type="text" name"username" placeholder="user name">
<input type="text" name="username">
<form action="" method="POST">

<?php

$username = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  if (strlen($username) > 8) {
    $err = true;
  }
  $err = false;
}
htmlspecialchars($username, ENT_QUOTES, 'utf-8';)
<?php if ($err) { echo "Too long!;"} ?>

//Cookie

setcookie("usernaem", "taguchi");

echo $_COOKIE['username']

sesseion_start();

$_SESSION['username'] = "taguchi";

echo $_SESSION['username'];