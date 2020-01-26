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

/**
 * preg_match: trueなら1, falseなら0を返す。
 */
$pattern = '/\d{7}/';
$bool = preg_match($pattern, $zipcode);
// echo $bool . "\n";
// echo gettype($bool);

/**
 * 正規表現がtrueで文字列が7の時だけ住所を返す。
 */
if ($bool === 1 && mb_strlen($zipcode) === 7) {
  echo $zipcode . "\n";
  getAddress($zipcode);
} else {
  echo "半角整数7文字で入力してください。";
}