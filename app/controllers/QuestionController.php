<?php
/**
* Created by HIR0Y0SHI on 2017/06/09
*/

namespace App\Controller;

use App\Controller\BaseController;
use App\Models\Question;

class QuestionAPIController extends BaseController {

    const QUESTION_IMAGE_PATH = __DIR__ . '/../../public/images/questions/';

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
    public function render() {
        $q = new Question($this->app->db);
        $r = $q->getBeastHouses();
        echo '<pre>';
        var_dump($r);
        echo '</pre>';
        // $this->app->view->render($this->response, 'management/login.html');
    }

}