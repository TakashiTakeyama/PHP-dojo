### 作成したユーザーに対して権限をつける
```
GRANT all privileges ON sampledb.* TO 'sample'@'localhost';
-- ユーザーを作成する
CREATE USER 'sample'@'localhost'
IDENTIFIED BY 'password';
PHPからmysqlを使用するためにはAPIを利用する。
mysqlとの接続のしかた三種類ある。

mysql関数で接続する（5系の時は使用していたが現在の7系では使用できない）
mysqliクラスを使用する。
PDOクラスを使用する。

CREATE TABLE members (
  id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  last_name VARCHAR(50),
  first_name VARCHAR(50),
  age TINYINT UNSIGNED,
  PRIMARY KEY(id)
);