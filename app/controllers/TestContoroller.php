<?php
/**
* Created by HIR0Y0SHI on 2017/06/01
*/


namespace App\Controller;

class TestController {

    private $app;

    function __construct($app) {
        $this->app = $app;
    }

    function test() {
        return $this->app->render($response, 'web/sample', ['name' => 'hoge']);
    }
}