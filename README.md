# とべマスター

## 構成
* slim/slim      : ^3.1
* slim/php-view  : ^2.0
* slim/twig-view : 1.*
* PHP 5.6


## アクセスURL一覧

### WEB側

**クイズ画面TOP**
* /tobe_master/web/quiz


**複数で遊ぶ画面**
* /tobe_master/web/quiz/multiple


**一人で遊ぶ画面**
* /tobe_master/web/quiz/one


### API

**みんなで遊ぶ問題　難易度：簡単　問題数：３問**
* /tobe_master/api/question/multiple/1

**みんなで遊ぶ問題　難易度：普通 問題数：３問**
* /tobe_master/api/question/multiple/2

**みんなで遊ぶ問題　難易度：難しい 問題数：３問**
* /tobe_master/api/question/multiple/3

**みんなで遊ぶ問題　難易度：最終画面 問題数：１問**
* /tobe_master/api/question/multiple/4



### 管理側

**ログイン画面**
* /tobe_master/login

**管理TOP画面**
* /tobe_master/management

**クイズ追加画面**
* /tobe_master/management/quiz/make


## DB

1. DBの作成と、アクセスできるユーザーの追加

docs/create.sql

2. テーブルの追加

docs/db.sql

3. ビューの追加

docs/view.sql


## ルーティングについて

役割ごとにファイルを分けて行う。
`src/routes`にルーティングファイルを格納。

* `api.router.php` : API関連のルーティング
* `management.router.php` : 管理側のルーティング
* `web.router.php` : Webアプリ側のルーティング