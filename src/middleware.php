<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

// $app->add(new \Slim\Csrf\Guard);

$app->add(new \Slim\Middleware\Session([
  'name' => 'tobe_session',
  'autorefresh' => true,
  'lifetime' => '10 minutes'
]));