<?php
/**
* Created by HIR0Y0SHI on 2017/06/09
*/

namespace App\Controller;

class BaseController {
    protected $app;
    protected $response;

    public function __construct($app, $response) {
        $this->app = $app;
        $this->response = $response;
    }
}