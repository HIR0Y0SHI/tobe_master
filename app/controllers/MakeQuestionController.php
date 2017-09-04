<?php
/**
* Created by HIR0Y0SHI on 2017/06/09
*/

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Question;

class MakeQuestionController extends BaseController {

    const QUESTION_IMAGE_PATH = __DIR__ . '/../../public/images/questions/';

    /**
     * 問題を検索する
     *
     * @access public
     * @param array $params
     * @param array $files
     */
    public function searchQuestion($path,$params,$page) {

        $message = null;
        $bh = null;

        session_start(); // セッションを再開

        if (!empty($params)) {
            $_SESSION['params'] = $params;
        }

        // DBの起動確認
        if (empty($this->app->db)) {
            $message = 'データベースが起動していません。';
        }

        // 問題がなければ
        if (empty($message)) {
            try {
                $question = new Question($this->app->db);
                $questions = $question->searchQuestion($params,$page);
                $bh = $question->getBeastHouses();
                $difficulty = $question->getDifficulty();
                $solution = $question->getSolution();
            } catch (PDOException $e) {
                $message = 'データベースでエラーが発生しました。';
            }
        }
        $this->app->view->render($this->response, 'management/'.$path, array('message' => $message, 'area' => $bh, 'questions' => $questions, 'difficulty' => $difficulty, 'solution' => $solution,'pagination' => $_SESSION['pagination']));

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

        // 画像ファイル名生成
        $fileName = $date . '_1_1.' . $this->getExpanded($newfile->getClientFilename());

        // 画像ファイル登録
        $this->uploadFile($newfile, $fileName);

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
                $params = array_merge($params,array('pattern_id'=>'1','problem_image_path'=>$fileName));
                $question = new Question($this->app->db);
                $bh = $question->registration($params);
            } catch (PDOException $e) {
                $message = 'データベースでエラーが発生しました。';
            }
        }
    }

    /**
     * Bパターンの問題を追加する
     *
     * @access public
     * @param array $params
     * @param array $files
     */
    public function addQuestionB($params, $files) {

        $newfile = $files['correct_image'];
        $newfile2 = $files['incorrect_image'];
        // ファイル名に使う日付を生成
        $date = date('YmdHis');
        // 画像ファイル名生成
        $fileName = $date . '_2_1.' . $this->getExpanded($newfile->getClientFilename());
        $fileName2 = $date . '_2_2.' . $this->getExpanded($newfile2->getClientFilename());
        // 画像ファイル登録
        $this->uploadFile($newfile, $fileName);
        $this->uploadFile($newfile2, $fileName2);

        $message = null;
        $bh = null;


        // DBの起動確認
        if (empty($this->app->db)) {
            $message = 'データベースが起動していません。';
        }

        // 問題がなければ
        if (empty($message)) {
            try {
                $params = array_merge($params,array('pattern_id'=>'2','first_image_path'=>$fileName,'second_image_path'=>$fileName2));
                $question = new Question($this->app->db);
                $bh = $question->registration($params);
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
     * Cパターンの問題を追加する
     *
     * @access public
     * @param array $params
     * @param array $files
     */
    public function addQuestionC($params, $files) {

        $newfile = $files['first_problem_image'];
        $newfile2 = $files['second_problem_image'];


        // ファイル名に使う日付を生成
        $date = date('YmdHis');

        // 画像ファイル名生成
        $fileName = $date . '_3_1.' . $this->getExpanded($newfile->getClientFilename());
        $fileName2 = $date . '_3_2.' . $this->getExpanded($newfile2->getClientFilename());

        // 画像ファイル登録
        $this->uploadFile($newfile, $fileName);
        $this->uploadFile($newfile2, $fileName2);

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
                $params = array_merge($params,array('pattern_id'=>'3','first_image_path'=>$fileName,'second_image_path'=>$fileName2));
                $question = new Question($this->app->db);
                $bh = $question->registration($params);
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

    /**
     * 問題を削除する
     *
     * @access public
     * @param integer $id
     */
    public function deleteQuestion($id) {

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
                $bh = $question->deleteQuestion($id);
                $message = '削除完了しました。';

            } catch (PDOException $e) {
                $message = 'データベースでエラーが発生しました。';
            }
        }

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

        $this->app->view->render($this->response, 'management/'.$path, array('message' => $message, 'area' => $bh, 'questions' => $questions, 'difficulty' => $difficulty, 'solution' => $solution, 'pagination' => $_SESSION['pagination']));
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