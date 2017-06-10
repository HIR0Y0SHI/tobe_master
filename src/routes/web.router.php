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