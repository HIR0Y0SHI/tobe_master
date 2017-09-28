<?php
/**
 * Created by KUWANO on 2017/06/29
 */

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Area;
use App\Models\Question;

class MakeAreaController extends BaseController {
    
    /**
     * エリアを追加する
     *
     * @access public
     * @param array $params
     */
    public function addArea($params) {
        $message = null;
        $bh = null;

        // DBの起動確認
        if (empty($this->app->db)) {
            $message = 'データベースが起動していません。';
        }

        // 問題がなければ
        if (empty($message)) {
            try {
                $question = new Area($this->app->db);
                $bh = $question->registration($params);

            } catch (PDOException $e) {
                $message = 'データベースでエラーが発生しました。';
            }
        }
        return $message;
    }

    /**
     * エリアを更新する
     *
     * @access public
     * @param array $params
     */
    public function updateArea($params) {
        $message = null;
        $bh = null;

        // DBの起動確認
        if (empty($this->app->db)) {
            $message = 'データベースが起動していません。';
        }

        // 問題がなければ
        if (empty($message)) {
            try {
                $question = new Area($this->app->db);
                $bh = $question->update($params);

            } catch (PDOException $e) {
                $message = 'データベースでエラーが発生しました。';
            }
        }
        return $message;

    }

    /**
     * エリアを削除する
     *
     * @access public
     * @param array $params
     */
    public function deleteArea($beast_house_id) {

        $message = null;
        $bh = null;

        // DBの起動確認
        if (empty($this->app->db)) {
            $message = 'データベースが起動していません。';
        }

        // 問題がなければ
        if (empty($message)) {
            try {
                $question = new Area($this->app->db);
                $bh = $question->delete($beast_house_id);

            } catch (PDOException $e) {
                $message = 'データベースでエラーが発生しました。';
            }
        }

        return $message;

    }

    // エリア管理画面、再表示メソッド
    public function render($path,$mes) {

        $message = null;
        $bh = null;

        if ($mes != ""){
            $message = $mes;
        }else{
            $message = null;
        }

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

        $this->app->view->render($this->response, 'management/'.$path, array('message' => $message, 'area' => $bh));
    }
}