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
})->setName('login');



// 管理TOP画面
// MEMO: 画面がまだない
$app->get('/management', function($request, $response, $args) {
    // return $this->view->render($response, 'management/login.html');
    // $_SESSION['user'] = 'dgfhgvj,hbk.jnlk;slefmanl:wdbf;ai';
    $session = new \SlimSession\Helper;
    echo $session->user;
    App\Auth::check($this, $response);
    exit;
});

// クイズ管理画面
$app->get('/management/quiz', function($request, $response, $args) {
    $message = "";
    App\Auth::check($this, $response);

    $question = new App\Controllers\MakeQuestionController($this, $response);
    $question->render('topquestion.html',$message);
});


// クイズ作成画面
$app->get('/management/quiz/make', function($request, $response, $args) {
    $message = "";
    App\Auth::check($this, $response);
    //$url = $this->router->pathFor('login');
    // return $response->withStatus(302)->withHeader('Location', $url);

    $question = new App\Controllers\MakeQuestionController($this, $response);
    $question->render('makeQuestion.html',$message);
    // return $this->view->render($response, 'management/makeQuestion.html', array('message' => $message));
});

// クイズ検索
$app->get('/management/quiz/{page}', function($request, $response, $args) {

    App\Auth::check($this, $response);
    $request->getBody();

    echo '<pre>';
    echo 'ここはID番号'.$args['page'].'のページです。';
    echo '</pre>';

    //$question = new App\Controllers\MakeQuestionController($this, $response);
    //$question->searchQuestion('topquestion.html',$params,$args['page']);
});


// エリア作成画面
$app->get('/management/area', function($request, $response, $args) {

    App\Auth::check($this, $response);

    $message = null;
    $mkc = new App\Controllers\MakeAreaController($this, $response);
    $mkc->render('area.html',$message);
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


// ログアウト
$app->get('/logout', function($request, $response, $args) {
    App\Auth::logout($this, $response);
});


/* ==================================================================================================== */
// POST
/* ==================================================================================================== */

// ログイン処理
$app->post('/login', function($request, $response, $args) {
    
    $params = $request->getParsedBody();
    $management = new App\Controllers\ManagementController($this, $response);
    $management->login($params["inputId"], $params["inputPassword"]);
});

// クイズ検索
$app->post('/management/quiz/search', function($request, $response, $args) {

    App\Auth::check($this, $response);

    $params = $request->getParsedBody();
    $request->getBody();
    $question = new App\Controllers\MakeQuestionController($this, $response);
    $question->searchQuestion('topquestion.html',$params,$args['page']);
});

// クイズ検索
$app->get('/management/quiz/search/{page}', function($request, $response, $args) {

    App\Auth::check($this, $response);

    $params = $request->getParsedBody();
    $request->getBody();
    $question = new App\Controllers\MakeQuestionController($this, $response);
    $question->searchQuestion('topquestion.html',$params,$args['page']);
});




// クイズ追加（Aパターン）
$app->post('/management/quiz/a', function($request, $response, $args) {

    App\Auth::check($this, $response);

    $files = $request->getUploadedFiles();
    $params = $request->getParsedBody();
    $question = new App\Controllers\MakeQuestionController($this, $response);
    $message = $question->addQuestionA($params, $files);
    $question->render('makeQuestion.html',$message);

});



// クイズ追加（Bパターン）
$app->post('/management/quiz/b', function($request, $response, $args) {

    App\Auth::check($this, $response);

    $files = $request->getUploadedFiles();
    $params = $request->getParsedBody();
    $question = new App\Controllers\MakeQuestionController($this, $response);
    $message = $question->addQuestionB($params, $files);
    $question->render('makeQuestion.html',$message);
});



// クイズ追加（Cパターン）
$app->post('/management/quiz/c', function($request, $response, $args) {

    App\Auth::check($this, $response);

    $files = $request->getUploadedFiles();
    $params = $request->getParsedBody();
    $question = new App\Controllers\MakeQuestionController($this, $response);
    $message = $question->addQuestionC($params, $files);
    $question->render('makeQuestion.html',$message);
});


// クイズ編集（Aパターン）
$app->post('/management/quiz/update/a', function($request, $response, $args) {

    App\Auth::check($this, $response);

    $files = $request->getUploadedFiles();
    $params = $request->getParsedBody();
    $question = new App\Controllers\UpdateQuestionController($this, $response);
    $question->updateQuestionA($params, $files);

    $question2 = new App\Controllers\MakeQuestionController($this, $response);
    $question2->searchQuestion('topquestion.html',$params,$args['page']);
});

// クイズ編集（Bパターン）
$app->post('/management/quiz/update/b', function($request, $response, $args) {

    App\Auth::check($this, $response);

    $files = $request->getUploadedFiles();
    $params = $request->getParsedBody();
    $question = new App\Controllers\UpdateQuestionController($this, $response);
    $question->updateQuestionB($params, $files);

    $question2 = new App\Controllers\MakeQuestionController($this, $response);
    $question2->searchQuestion('topquestion.html',$params,$args['page']);
});

// クイズ編集（Cパターン）
$app->post('/management/quiz/update/c', function($request, $response, $args) {

    App\Auth::check($this, $response);

    $files = $request->getUploadedFiles();
    $params = $request->getParsedBody();
    $question = new App\Controllers\UpdateQuestionController($this, $response);
    $question->updateQuestionC($params, $files);

    $question2 = new App\Controllers\MakeQuestionController($this, $response);
    $question2->searchQuestion('topquestion.html',$params,$args['page']);
});



// エリア追加
$app->post('/management/area', function($request, $response, $args) {

    App\Auth::check($this, $response);

    $message = null;
    $params = $request->getParsedBody();
    $area = new App\Controllers\MakeAreaController($this, $response);
    $message = $area->addArea($params);
    $area->render('area.html',$message);
});

/* ==================================================================================================== */
// PUT
/* ==================================================================================================== */

// エリア更新
$app->put('/management/area/{beast_house_id}', function($request, $response, $args) {

    App\Auth::check($this, $response);

    $params = $request->getParsedBody();
    $area = new App\Controllers\MakeAreaController($this, $response);
    $message = $area->updateArea($params);
    $area->render('area.html',$message);
});

/* ==================================================================================================== */
// DELETE
/* ==================================================================================================== */

// クイズ削除
$app->delete('/management/quiz/delete/{question_id}', function($request, $response, $args) {

    App\Auth::check($this, $response);

    $question = new App\Controllers\MakeQuestionController($this, $response);
    $message = $question->deleteQuestion($args['question_id']);
    $question->render('topquestion.html',$message);
});

// エリア削除
$app->delete('/management/area/{beast_house_id}', function($request, $response, $args) {

    App\Auth::check($this, $response);


    $area = new App\Controllers\MakeAreaController($this, $response);
    $message = $area->deleteArea($args['beast_house_id']);
    $area->render('area.html',$message);
});


/* ==================================================================================================== */
// TEST
/* ==================================================================================================== */

function dump($args) {
    echo '<pre>';
    var_dump($args);
    echo '<pre>';
    exit;
}
