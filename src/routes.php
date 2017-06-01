<?php
/**
* Created by HIR0Y0SHI on 2016/05/31
* ルーティングを行う
*/


/* ==================================================================================================== */
// WEB側
/* ==================================================================================================== */

// クイズTOP
$app->get('/web/{category}', function($request, $response, $args) {
    $category = $args['category'];
    $path = 'web/';

    switch ($category) {
        case 'quizu':
            $path .= 'quizu_top.html';
            break ;
        default :
            $path .= '404.html';
    }

    return $this->view->render($response, $path, ['category' => $category]);
});


// クイズのモード選択
$app->get('/web/quizu/{mode}', function($request, $response, $args) {
    $mode = $args['mode'];
    $path = 'web/';

    switch ($mode) {
        case 'one':
            $path .= 'quizu_one_mode.html';
            break ;
        case 'multiple':
            $path .= 'quizu_multiple_mode.html';
            break ;
        default :
            $path .= '404.html';
    }

    return $this->view->render($response, $path, ['mode' => $mode]);
});


$app->get('/sample/{name}', '\App\Controller\TestController:test');












/* ==================================================================================================== */
// 管理側
/* ==================================================================================================== */










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