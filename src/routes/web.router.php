<?php
/**
* Created by HIR0Y0SHI on 2017/06/10
*
* Webアプリ側のルーティングを行う
*/

/* ==================================================================================================== */
// WEB側
/* ==================================================================================================== */

// クイズTOP
$app->get('/web/quiz', function($request, $response, $args) {
    return $this->view->render($response, 'web/quiz_top.html');
});


// みんなで遊ぶ
$app->get('/web/quiz/multiple', function($request, $response, $args) {
    return $this->view->render($response, 'web/quiz_multiple_mode.html');
});



$app->get('/sample/{name}', '\App\Controllers\TestController:test');
// $app->get('/sample/{name}', function() use ($app) {
//     $test = new \App\Controllers\TestController($app);
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

    return $this->view->render($response, 'web/quiz_one_mode.html');
});