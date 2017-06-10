<?php
/**
* Created by HIR0Y0SHI on 2017/06/09
*/

namespace App\Controller;

class QuestionController extends \App\Controller\BaseController {

    /**
    * 一人で遊ぶ問題を取得する
    * 
    * @access public
    * @param string $number 問題番号
    */
    public function oneQuestionAPI($number) {

    }

    /**
    * 複数で遊ぶ問題を取得する
    * 
    * @access public
    * @param string $number 問題番号
    */
    public function multipleQuestionAPI($number) {
        
    }

    // TEST
    private function render() {
        $this->app->view->render($this->response, 'management/login.html');
    }
}