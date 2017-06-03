-- ユーザーの作成
-- ユーザー名: tobe
-- パスワード: tobe

CREATE USER tobe@localhost IDENTIFIED BY "tobe";

-- 権限の追加
-- tobe_masterに対する、すべての権限を付与

GRANT ALL ON tobe_master.* TO 'tobe'@'localhost';