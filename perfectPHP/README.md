## Apacheとは  
- アパッチと読む。
- 正式名称は「Apache HTTP Server」。
- オープンソースソフトウェア(OSS)で、無償で誰でも利用可能。
- マルチプロセスモデル（接続ごとにプロセスをフォーク≒コピーする）なのでメモリがいっぱいになりやすい。
    - つまり、リクエストを処理するごとにリソースが枯渇していってしまう。
- モジュールにより基本機能を拡張可能できるようになっている。
    - これを利用すればイベント駆動モデルにもできるが、Nginxの方が性能には及ばないらしい。
- CMS(Contents Management System)を利用する際に、比較的簡単な設定で済む。
- 約20年間OSSとして公開され、バージョンアップした結果により信頼性が高い。
- 最近はnginxと同じぐらいのシェア率。

WebサーバでPHPを使うためには、Apacheの設定ファイルを変えなくてはいけない。

設定ファイルの場所は、`/etc/apache2/httpd.conf`なので、

```linux
vim /etc/apache2/httpd.conf
```

を叩き、ファイル中の

```/etc/apache2/httpd.conf
#LoadModule php5_module libexec/apache2/libphp5.so
```

の行頭の`#`（コメントアウト記号）を消して

```/etc/apache2/httpd.conf
LoadModule php5_module libexec/apache2/libphp5.so
```

とすればWebサーバ上でPHPが使えるようになる。

※設定ファイルの更新内容を反映させるためにはApacheの再起動が必要なので注意！