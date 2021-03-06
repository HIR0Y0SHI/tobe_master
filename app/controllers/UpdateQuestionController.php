<?php
/**
 * Created by HIR0Y0SHI on 2017/06/09
 */

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Question;

class UpdateQuestionController extends BaseController {

    const QUESTION_IMAGE_PATH = __DIR__ . '/../../public/images/questions/';

    /**
     * Aパターンの問題を編集する
     *
     * @access public
     * @param array $params
     * @param array $files
     */
    public function updateQuestionA($params, $files) {



        // ファイル名に使う日付を生成
        $date = date('YmdHis');

        $params = array_merge($params,array('pattern_id'=>'1'));

        if ($params['problem_image_in']) {
            $newfile = $files['problem_image'];

            // 画像ファイル名生成
            $fileName = $date . '_1_1.' . $this->getExpanded($newfile->getClientFilename());

            // 画像ファイル登録
            $this->uploadFile($newfile, $fileName);

            $params = array_merge($params,array('problem_image_path'=>$fileName));
        }

        // Answerタイプ選別
        if ($params['answertype'] == 'answertype1') {
            if ($params['answer'] == 'Yes') {
                $params['correct_answer'] = 'はい';
                $params['incorrect_answer'] = 'いいえ';
            }else{
                $params['correct_answer'] = 'いいえ';
                $params['incorrect_answer'] = 'はい';
            }
        }

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
                $bh = $question->update($params);
            } catch (PDOException $e) {
                $message = 'データベースでエラーが発生しました。';
            }
        }
    }

    /**
     * Bパターンの問題を編集する
     *
     * @access public
     * @param array $params
     * @param array $files
     */
    public function updateQuestionB($params, $files) {

        // ファイル名に使う日付を生成
        $date = date('YmdHis');
        $params = array_merge($params,array('pattern_id'=>'2'));

        if ($params['correct_image_in']) {
            $newfile = $files['correct_image'];
            // 画像ファイル名生成
            $fileName = $date . '_2_1.' . $this->getExpanded($newfile->getClientFilename());
            // 画像ファイル登録
            $this->uploadFile($newfile, $fileName);
            $params = array_merge($params,array('first_image_path'=>$fileName));
        }

        if ($files['incorrect_image_in']) {
            $newfile2 = $files['incorrect_image'];
            // 画像ファイル名生成
            $fileName2 = $date . '_2_2.' . $this->getExpanded($newfile2->getClientFilename());
            $this->uploadFile($newfile2, $fileName2);
            $params = array_merge($params,array('second_image_path'=>$fileName2));
        }

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
                $bh = $question->update($params);
            } catch (PDOException $e) {
                $message = 'データベースでエラーが発生しました。';
            }
        }

        /*//$this->app->view->render($this->response, 'management/makeQuestion.html');
        echo '<pre>';
        //var_dump($bh);
        var_dump($params);
        var_dump($files);
        echo '</pre>';

        exit;*/
    }

    /**
     * Cパターンの問題を編集する
     *
     * @access public
     * @param array $params
     * @param array $files
     */
    public function updateQuestionC($params, $files) {

        // ファイル名に使う日付を生成
        $date = date('YmdHis');
        $params = array_merge($params,array('pattern_id'=>'3'));

        if ($files['first_problem_image_in']){
            $newfile = $files['first_problem_image'];
            //画像ファイル名生成
            $fileName = $date . '_3_1.' . $this->getExpanded($newfile->getClientFilename());
            // 画像ファイル登録
            $this->uploadFile($newfile, $fileName);
            $params = array_merge($params,array('first_image_path'=>$fileName));
        }

        if ($files['second_problem_image_in']){
            $newfile2 = $files['second_problem_image'];
            //画像ファイル名生成
            $fileName2 = $date . '_3_2.' . $this->getExpanded($newfile2->getClientFilename());
            // 画像ファイル登録
            $this->uploadFile($newfile2, $fileName2);
            $params = array_merge($params,array('second_image_path'=>$fileName2));
        }


        // Answerタイプ選別
        if ($params['answertype2'] == 'answertype1') {
            if ($params['answer'] == 'Yes') {
                $params['correct_answer'] = 'はい';
                $params['incorrect_answer'] = 'いいえ';
            }else{
                $params['correct_answer'] = 'いいえ';
                $params['incorrect_answer'] = 'はい';
            }
        }

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
                $bh = $question->update($params);
            } catch (PDOException $e) {
                $message = 'データベースでエラーが発生しました。';
            }
        }

        /* //$this->app->view->render($this->response, 'management/makeQuestion.html');
         echo '<pre>';
         //var_dump($bh);
         var_dump($params);
         var_dump($files);
         exit;*/
    }

    // クイズ管理画面、再表示メソッド
    public function render($path) {
        $message = null;
        $bh = null;
        $questions = null;
        $difficulty = null;
        $solution = null;

        // DBの起動確認
        if (empty($this->app->db)) {
            $message = 'データベースが起動していません。';
        }

        // 問題がなければ
        if (empty($message)) {
            try {
                $question = new Question($this->app->db);
                $bh = $question->getBeastHouses();
                $questions = $question->getQuestion(1);
                $difficulty = $question->getDifficulty();
                $solution = $question->getSolution();

            } catch (PDOException $e) {
                $message = 'データベースでエラーが発生しました。';
            }
        }

        $this->app->view->render($this->response, 'management/'.$path, array('message' => $message, 'area' => $bh, 'questions' => $questions, 'difficulty' => $difficulty, 'solution' => $solution));
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