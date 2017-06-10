<?php
/**
* Created by HIR0Y0SHI on 2017/06/10
*
* 管理画面のルーティングを行う
*/


/* ==================================================================================================== */
// 管理側
/* ==================================================================================================== */

// ログイン画面
$app->get('/management', function($request, $response, $args) {
    return $this->view->render($response, 'management/login.html');
});

// ログイン処理
$app->post('/management/login', function($request, $response, $args) {
    $params = $request->getParsedBody();
    $management = new App\Controller\ManagementController($this, $response);
    $management->login($params["inputId"], $params["inputPassword"]);
});

// クイズ作成画面
$app->get('/management/quizu/make', function($request, $response, $args) {
    return $this->view->render($response, 'management/makeQuestion.html');
});

// クイズ追加（Aパターン）
$app->post('/management/quizu/make/a', function($request, $response, $args) {
    $params = $request->getParsedBody();
    exit;
    return $this->view->render($response, 'management/makeQuestion.html');
});

// TEST
$app->get('/management/test', function($request, $response, $args) {
    // return $this->view->render($response, 'management/test.html');
    // $mapper = new App\Models\Management($this->db);
    // $val = $mapper->checkUser('admin');
    // var_dump($val);
    // echo base64_encode('password');
    
    
});