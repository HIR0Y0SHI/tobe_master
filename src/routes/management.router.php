<?php
/**
* Created by HIR0Y0SHI on 2017/06/10
*
* 管理画面のルーティングを行う
*/


/* ==================================================================================================== */
// GET
/* ==================================================================================================== */

// ログイン画面
$app->get('/login', function($request, $response, $args) {
    return $this->view->render($response, 'management/login.html');
});

// 管理TOP画面
// MEMO: 画面がまだない
$app->get('/management', function($request, $response, $args) {
    // return $this->view->render($response, 'management/login.html');
});


// クイズ作成画面
$app->get('/management/quiz/make', function($request, $response, $args) {
    $mkc = new App\Controller\MakeQuestionController($this, $response);
    $mkc->render();
    // return $this->view->render($response, 'management/makeQuestion.html', array('message' => $message));
});



// TEST
$app->get('/management/test', function($request, $response, $args) {
    // return $this->view->render($response, 'management/test.html');
    // $mapper = new App\Models\Management($this->db);
    // $val = $mapper->checkUser('admin');
    // var_dump($val);
    // echo base64_encode('password');

    $q = new App\Controller\MakeQuestionController($this, $response);
    $q->render();
    
});




/* ==================================================================================================== */
// POST
/* ==================================================================================================== */

// ログイン処理
$app->post('/management/login', function($request, $response, $args) {
    $params = $request->getParsedBody();
    $management = new App\Controller\ManagementController($this, $response);
    $management->login($params["inputId"], $params["inputPassword"]);
});



// クイズ追加（Aパターン）
$app->post('/management/quiz/make/a', function($request, $response, $args) {
    $files = $request->getUploadedFiles();
    $params = $request->getParsedBody();
    $question = new App\Controller\MakeQuestionController($this, $response);
    $question->addQuestionA($params, $files);
});

function dump($args) {
    echo '<pre>';
    var_dump($args);
    echo '<pre>';
    exit;
}