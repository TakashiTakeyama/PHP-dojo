<?php
function getAddress($zipcode) {
  
  $params = [
    'zipcode' => $zipcode,
  ];
  
  $base_url = "https://zip-cloud.appspot.com/api/search?";
  /**
   * $base_urlにエンコードされたクエリを追加する。
   */
  
  $url = $base_url . http_build_query($params);
  
  echo $url . "\n";
  $ch = curl_init();
  
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  
  /**
   * curl_exec: curlセッションを実行
   */
  curl_exec($ch);
}

echo "郵便番号を入力してください。" . "\n";
/**
 * 郵便番号を入力してintgerに変換
 */
$zipcode = intval(fgets(STDIN));
// echo gettype($zipcode);
getAddress($zipcode);