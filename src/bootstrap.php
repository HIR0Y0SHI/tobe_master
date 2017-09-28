<?php
/**
* Created by HIR0Y0SHI on 2017/06/10
*
* src配下のbootstrapファイル
*/


define('SRC_PATH'        , __DIR__ . '/../src/');
define('ROUTER_PATH'     , __DIR__ . '/../src/routes/');

foreach (glob(SRC_PATH . '*.php') as $contorollerPhpFile) {
    require_once $contorollerPhpFile;
}

foreach (glob(ROUTER_PATH . '*.php') as $contorollerPhpFile) {
    require_once $contorollerPhpFile;
}