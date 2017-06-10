<?php
/**
* Created by HIR0Y0SHI on 2016/05/31
* ルーティングを行う
*/


/* ==================================================================================================== */
// WEB側
/* ==================================================================================================== */

// クイズTOP
$app->get('/web/quizu', function($request, $response, $args) {
    return $this->view->render($response, 'web/quizu_top.html');
});

// 一人で遊ぶ
$app->get('/web/quizu/one', function($request, $response, $args) {
    return $this->view->render($response, 'web/quizu_one_mode.html');
});

// みんなで遊ぶ
$app->get('/web/quizu/multiple', function($request, $response, $args) {
    return $this->view->render($response, 'web/quizu_multiple_mode.html');
});



$app->get('/sample/{name}', '\App\Controller\TestController:test');
// $app->get('/sample/{name}', function() use ($app) {
//     $test = new \App\Controller\TestController($app);
//     $test->test();
// });

$app->get('/db', function($request, $response, $args) {

    if (empty($this->db)) {
        echo 'データベースエラーが発生しました。';
        exit;
    }

    try {
        $mapper = new App\Models\Question($this->db);
        $test = $mapper->getQuestion();
        var_dump($test);
    } catch (PDOExeption $e) {
        echo $e->getMessage();
    }
    

    exit;

    return $this->view->render($response, 'web/quizu_one_mode.html');
});

 










/* ==================================================================================================== */
// 管理側
/* ==================================================================================================== */

// ログイン画面
$app->get('/management', function($request, $response, $args) {
    return $this->view->render($response, 'management/login.html');
});

// ログイン処理
$app->post('/management/login', function($request, $response, $args) {
    return $this->view->render($response, 'management/login.html');
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

    $management = new App\Controller\ManagementController($this, $response);
    $management->login('admin', 'passwrd');
});









/* ==================================================================================================== */
// クイズ API
/* ==================================================================================================== */

$app->get('/api/question/one/{number}', function($request, $response, $args) {
    $response->getBody()->write("Question! " . $args['number']);
    return $response;
});







/* ==================================================================================================== */
// APIのモック
// テスト用なので、最終的には削除する
/* ==================================================================================================== */

//Mock
// 一人で遊ぶ
$app->get('/api/mock/question/one/{number}', function($request, $response, $args) {

    $number = $args['number'];

    $question = 'この動物はカピパラ？';

    $json = [
        'pattern' => 'A',
        'question' => mb_convert_encoding($question, "UTF-8", "auto"),
        'choices' => [
            'ans' => 'Yes',
            'inc' => 'No'
        ],
        'image' => 'sample.png'
    ];

    echo json_encode($json, JSON_UNESCAPED_UNICODE);

});


// 複数で遊ぶ（画像２枚の解答）
$app->get('/api/mock/question/multiple/{number}', function($request, $response, $args) {

    $number = $args['number'];

    $question = 'カピパラはどっち？';

    $json = [
        'pattern' => 'B',
        'question' => mb_convert_encoding($question, "UTF-8", "auto"),
        'choices' => [
            'ans' => 'sample.png',
            'inc' => 'sample.png'
        ]
    ];

    echo json_encode($json, JSON_UNESCAPED_UNICODE);

});