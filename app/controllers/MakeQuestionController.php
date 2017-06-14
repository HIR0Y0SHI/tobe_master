<?php
/**
* Created by HIR0Y0SHI on 2017/06/09
*/

namespace App\Controller;

use App\Controller\BaseController;
use App\Models\Question;

class MakeQuestionController extends BaseController {

    const QUESTION_IMAGE_PATH = __DIR__ . '/../../public/images/questions/';



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

        $fileName = $date . '_1_1.' . $this->getExpanded($newfile->getClientFilename());
        $this->uploadFile($newfile, $fileName);



        // echo $params;
        echo '<pre>';
        var_dump($fileName);
        // var_dump($this->getExpanded($newfile->getClientFilename()));
        echo '</pre>';
        exit;
    }
    


    // TEST
    public function render() {
        $message = null;
        $bh = null;

        // DBの起動確認
        if (empty($this->app->db)) {
            $message = 'データベースが起動していません。';
        }

        // 問題がなければ
        if (empty($message)) {
            try {
                $question = new Question($this->app->db);
                $bh = $question->getBeastHouses();
            } catch (PDOException $e) {
                $message = 'データベースでエラーが発生しました。';
            }
        }

        $this->app->view->render($this->response, 'management/makeQuestion.html', array('message' => $message, 'area' => $bh));
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
        if ($file->getError() === UPLOAD_ERR_OK) {
            echo 'OK';
            $file->moveTo(MakeQuestionController::QUESTION_IMAGE_PATH . $fileName);
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