<?php
/**
* Created by HIR0Y0SHI on 2017/06/10
*
* APIのルーティングを行う
*/

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