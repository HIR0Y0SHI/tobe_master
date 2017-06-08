# とべマスター

## 構成
* slim/slim      : ^3.1
* slim/php-view  : ^2.0
* slim/twig-view : 1.*
* PHP 5.6


## アクセスURL一覧

### WEB側

**クイズ画面TOP**
* /tobe_master/web/quizu


**複数で遊ぶ画面**
* /tobe_master/web/quizu/multiple


**一人で遊ぶ画面**
* /tobe_master/web/quizu/one



### 管理側

**管理側TOP**
* /tobe_master/management

**クイズ追加画面**
* /tobe_master/management/quizu/make

## DB

1. DBの作成と、アクセスできるユーザーの追加

docs/create.sql

2. テーブルの追加

docs/db.sql