<?php

class User {
  public $name;
  public $email;
  public $age;
  public $arrays = [];

  public function user_info($name, $email, $age) {
    $this->name = $name;
    $this->email = $email;
    $this->age = $age;

    $arrays[0] = $name;
    $arrays[1] = $email;
    $arrays[2] = $age;

    print_r($arrays) . "\n";
    echo gettype($arrays) . "\n";
    //returnを省略した場合はNULLを返す。
    return $arrays;
  }

  //読み込んだだけでインスタンスが作成されるわけではない。
  // function __construct() {
  //   echo "インスタンスが作られる？";
  // }
}

$arr = new User();
// プロパティは読み込めない
// echo gettype($arrays);
$user = $arr->user_info('タカシ', 'email', 35);
//なんでNULLなのかわからない。
print_r($user);
echo gettype($user); // NULL

// $hoge = new User;