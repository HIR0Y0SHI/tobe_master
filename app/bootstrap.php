<?php
/**
* Created by HIR0Y0SHI on 2017/06/02
*/

session_cache_limiter('public');

define('ROOT_PATH'       , __DIR__ . '/../');
define('VENDOR_PATH'     , __DIR__ . '/../vendor/');
define('APP_PATH'        , __DIR__ . '/../app/');
define('MODEL_PATH'      , __DIR__ . '/../app/models/');
define('CONTROLLER_PATH' , __DIR__ . '/../app/controllers/');
define('PUBLIC_PATH'     , __DIR__ . '/../public/');




require_once VENDOR_PATH . 'autoload.php';

foreach (glob(APP_PATH . '*.php') as $appPhpFile) {
    require_once  $appPhpFile;
}


foreach (glob(MODEL_PATH . '*.php') as $modelPhpFile) {
    require_once $modelPhpFile;
}


foreach (glob(CONTROLLER_PATH . '*.php') as $contorollerPhpFile) {
    require_once $contorollerPhpFile;
}