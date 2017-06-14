<?php
/**
* Created by HIR0Y0SHI on 2017/06/05
*/

namespace App\Models;

use App\Mapper;

/**
* 問題関連のDBアクセスクラス
*
* @author HIR0Y0SHI
* @package Models
*/
class Question extends Mapper {

    // ゲームモードの定義
    const GAME_MODE_ONE      = 'one';
    const GAME_MODE_MULTIPLE = 'multiple';

    /**
    * 一人で遊ぶ問題を取得する
    * 
    * @access public
    * @param string $number 問題番号
    * @return int 問題数
    */
    public function count($game_mode) {

    }

    public function getQuestion() {
        $query = 'SELECT * FROM m_questions';
        $results = [];

        

        try {
            $stmt = $this->db->query($query);
            while($row = $stmt->fetch()) {
                $results[] = $row;
            }
        } catch (PDOException $e) {
            return 'データベースでエラーが発生しました。';
        }
        
        return $results;
    }



    /**
    * 獣舎一覧を取得する
    * 
    * @access public
    * @return bool trueなら成功
    */
    public function getBeastHouses() {
        $query = 'SELECT * FROM m_beast_house';
        $results = [];

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $results[] = $row;
            }

        } catch (PDOException $e) {
            throw $e;
        }

        return $results;
    }




    /**
    * 問題を登録する
    * 
    * @access public
    * @param string $prams 入力パラメータ
    * @return bool trueなら成功
    */
    public function registration($prams) {

    }
}