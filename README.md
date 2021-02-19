# sample_laravel

## 概要
Laravelを学習するために作成したサンプルのプログラムです。  
記事の作成・参照・更新・削除をするだけの単純なサイトです。

## 環境
Herokuで公開しています。  
https://yk-sample-laravel.herokuapp.com/

ローカルで動かすこともできます。

## ローカルでの実行手順

### 前提
ローカルのPCに下記のアプリが入ってる必要があります。

- VirtualBox
- Vagrant
- Vagrantのプラグイン
  - vagrant-docker-compose
  - vagrant-vbguest

### 手順
本リポジトリをクローンまたはダウンロードし、適当な場所に設置する。

設置したディレクトリ上で、下記のコマンドを実行すると、サーバーが起動します。  
(初回は結構時間がかかります)
```
> vagrant up
```

サーバーが起動したら、ブラウザから下記のURLでアクセスできます。
```
http://localhost/
```

停止する場合は、下記のコマンドを実行してください。
```
> vagrant halt
```
