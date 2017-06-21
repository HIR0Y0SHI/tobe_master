<?php
/**
* Created by HIR0Y0SHI on 2017/06/09
*/

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Question;

class QuestionAPIController extends BaseController {

    // 問題の画像が格納されているパス
    const QUESTION_IMAGE_PATH = __DIR__ . '/../../public/images/questions/';



    /**
    * 一人で遊ぶ問題を取得する
    * 実装するか分からない
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
        
        $json = [];

        // DBのチェック
        if (empty($this->app->db)) {
            $json = [
                'status' => 'failed',
                'message' => 'データベースが起動していません。'
            ];
        } else {
            // 問題の取得
            try {
                $question = new Question($this->app->db);
                $json = $question->getMultipleQuestions($number);
            } catch (PODException $e) {
                $json = [
                    'status' => 'failed',
                    'message' => 'データベースでエラーが発生しました。'
                ];
            }
        }

       $this->render($json);
    }


    

 
    // TEST
    private function render($json) {
         echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }

}