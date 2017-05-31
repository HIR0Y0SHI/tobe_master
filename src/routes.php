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

