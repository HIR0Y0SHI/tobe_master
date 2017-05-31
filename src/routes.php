<?php
// Routes

$app->get('/hello/[{name}]', function ($request, $response, $args) {
    $response->getBody()->write("Hello, " . $args['name']);
    return $response;
});


$app->get('/sample/{name}', function($request, $response, $args) {
    return $this->view->render($response, 'web/sample.html', ['name' => $args['name']]);
});

$app->get('/api/question/{number}', function($request, $response, $args) {
    $response->getBody()->write("Question! " . $args['number']);
    return $response;
});


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