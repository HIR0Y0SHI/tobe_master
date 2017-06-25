<?php
/**
* Created by HIR0Y0SHI on 2017/06/10
*
* 管理画面のルーティングを行う
*/


/* ==================================================================================================== */
// HOOK
/* ==================================================================================================== */

// 認証
// $app->hook('slim.before.dispatch', function() use ($app) {
//     // パスの取得
//     $path = $request->getUri()->getPath();
//     echo $path;
//     exit;
// });


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
    $mkc = new App\Controllers\MakeQuestionController($this, $response);
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

    $q = new App\Controllers\MakeQuestionController($this, $response);
    $q->render();
    
});




/* ==================================================================================================== */
// POST
/* ==================================================================================================== */

// ログイン処理
$app->post('/management/login', function($request, $response, $args) {
    $params = $request->getParsedBody();
    $management = new App\Controllers\ManagementController($this, $response);
    $management->login($params["inputId"], $params["inputPassword"]);
});



// クイズ追加（Aパターン）
$app->post('/management/quiz/make/a', function($request, $response, $args) {
    $files = $request->getUploadedFiles();
    $params = $request->getParsedBody();
    $question = new App\Controllers\MakeQuestionController($this, $response);
    $question->addQuestionA($params, $files);
});

function dump($args) {
    echo '<pre>';
    var_dump($args);
    echo '<pre>';
    exit;
}