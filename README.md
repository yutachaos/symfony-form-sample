for-symfony-form-sample
=========================

# 内容
symfony2でのFormTypeを利用した登録、validation処理の基本サンプル

## Description
動作環境は
php5.6,mysql 5.6.31
動作確認画面はdoctrineのCRUD自動生成コマンドで作成したものを基本に編集
`php app/console doctrine:generate:crud`
### dockerコンテナ

#### Apache
* Apacheのログは/tmpにaccess\_log、error\_logが出力されます
	* 出力先を変えたい場合は `docker-compose.yml` のvolumesを変更してコンテナを再作成してください
* コンテナ内部では `/var/www/app` で ホスト./をマウントしています
* ポートは8000番をバインドしています、変えたい場合は`docker-compose.yml`のportsを変えてコンテナを再作成してください

#### MySQL

* MySQLの公式DockerImageを使用しています
	* mysql:5.6.31を使用
* `docker/db_init` を `/docker-entrypoint-initdb.d`にマウントすることでDBの初期化を行っています
	* 1.create\_database.sql、2.create\_table.sql
* コンテナの3306とホストの3306をバインドしています、ツールなどからコンテナに接続することが出来ます
	* root / passwordでログインできます
	* \# mysql -h 127.0.0.1 -uroot -ppassword



## Requirement
php,docker,composer

## Install

- dockerで開発環境をコンテナ作成
```
docker-compose up -d
```
-  composerを実行する
symfonyの依存ファイルをinstallする  

```
php composer.phar -n --dev install
```
## Qiita
- http://qiita.com/yutaChaos/items/0ae0d1797db4cb16466c

## Licence

[MIT](https://github.com/tcnksm/tool/blob/master/LICENCE)

## Author

yutaChaos(https://github.com/yutachaos)
