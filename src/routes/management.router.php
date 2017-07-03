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
    // $_SESSION['user'] = 'dgfhgvj,hbk.jnlk;slefmanl:wdbf;ai';
    $auth = new App\Auth();
    $auth->check();
});

// クイズ管理画面
$app->get('/management/quiz', function($request, $response, $args) {
    $mkc = new App\Controllers\MakeQuestionController($this, $response);
    $mkc->render('topQuestion.html');
});


// クイズ作成画面
$app->get('/management/quiz/make', function($request, $response, $args) {
    $mkc = new App\Controllers\MakeQuestionController($this, $response);
    $mkc->render('makeQuestion.html');
    // return $this->view->render($response, 'management/makeQuestion.html', array('message' => $message));
});

// エリア作成画面
$app->get('/management/area', function($request, $response, $args) {
    $mkc = new App\Controllers\MakeQuestionController($this, $response);
    $mkc->render('area.html');
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



// クイズ追加（Bパターン）
$app->post('/management/quiz/make/b', function($request, $response, $args) {
    $files = $request->getUploadedFiles();
    $params = $request->getParsedBody();
    $question = new App\Controllers\MakeQuestionController($this, $response);
    $question->addQuestionB($params, $files);
});



// クイズ追加（Cパターン）
$app->post('/management/quiz/make/c', function($request, $response, $args) {
    $files = $request->getUploadedFiles();
    $params = $request->getParsedBody();
    $question = new App\Controllers\MakeQuestionController($this, $response);
    $question->addQuestionC($params, $files);
});

// エリア追加
$app->post('/management/area/make', function($request, $response, $args) {
    $params = $request->getParsedBody();
    $question = new App\Controllers\MakeAreaController($this, $response);
    echo '<pre>';
    var_dump($params);
    echo '<pre>';
    //$question->addArea($params);
});

// エリア更新
$app->post('/management/area/update', function($request, $response, $args) {
    $params = $request->getParsedBody();
    $question = new App\Controllers\MakeAreaController($this, $response);
    echo '<pre>';
    var_dump($params);
    echo '<pre>';
    //$question->addArea($params);
});

// エリア削除
$app->post('/management/area/delete', function($request, $response, $args) {
    $params = $request->getParsedBody();
    $question = new App\Controllers\MakeAreaController($this, $response);
    echo '<pre>';
    var_dump($params);
    echo '<pre>';
    //$question->addArea($params);
});

function dump($args) {
    echo '<pre>';
    var_dump($args);
    echo '<pre>';
    exit;
}
