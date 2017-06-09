<?php
/**
* Created by HIR0Y0SHI on 2017/06/09
*/

namespace App\Controller;

class QuestionController extends \App\Controller\BaseController {

    public function render() {
        $this->app->view->render($this->response, 'management/login.html');
    }
}