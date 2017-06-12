<?php
/**
* Created by HIR0Y0SHI on 2017/06/09
*/

namespace App\Controller;

use App\Controller\BaseController;

class QuestionController extends BaseController {

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



    /**
    * Aパターンの問題を追加する
    * 
    * @access public
    * @param array $params 
    * @param array $files 
    */
    public function addQuestionA($params, $files) {
        
        $newfile = $files['problem_image'];
        // ファイル名に使う日付を生成
        $date = date('YmdHis');

        // echo $params;
        echo '<pre>';
        var_dump($params);

        // var_dump($this->getExpanded($newfile->getClientFilename()));
        echo '</pre>';
        exit;
    }
    


    // TEST
    private function render() {
        $this->app->view->render($this->response, 'management/login.html')  ;
    }



    /**
    * ファイルをアップロードする
    * 
    * @access public
    * @param object $files 
    * @param string $fileName YmdHis_パターンID_連番
    * @return bool
    */
    public function uploadFile($file, $fileName) {
        if ($newfile->getError() === UPLOAD_ERR_OK) {
            echo 'OK';
            $file->moveTo(QuestionController::QUESTION_IMAGE_PATH . $fileName);
            return true;
        }
        return false;
    }



    /**
    * ファイルの拡張子を取得する
    * 
    * @access public
    * @param string $fileName 
    * @return string
    */
    public function getExpanded($fileName) {
        $info = new \SplFileInfo($fileName);
        return $info->getExtension();   
    }
}