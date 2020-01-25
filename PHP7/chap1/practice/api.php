<?php

$URL = "https://zip-cloud.appspot.com/api/search";

class ApiGet {
  static $URL;
  public $addres;
  public $zipcode;
  
  public function __construct()
  {
    // $curl = curl_init(self::$URL);
    $curl = curl_init("https://zip-cloud.appspot.com/api/search");
    $zipcode = trim(fgets(STDIN));
    $params = [
      'zipcode' => $zipcode,
    ];

    curl_setopt($curl, CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $params); // パラメータをセット
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    curl_close($curl);
    // var_dump($response);
    return $response;
  }

  // public function getJson($curl) {
  //   return $json;
  // }
}

$obj = new ApiGet();
// $result = $obj->getJson();

var_dump($obj) . "\n";