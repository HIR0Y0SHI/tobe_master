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



    // 難易度ごとの問題数
    const MUNBER_OF_QUESTIONS_DIC = [
        '1' => '3',
        '2' => '3',
        '3' => '3',
        '4' => '1'
    ];



    /**
    * 一人で遊ぶ問題を取得する
    * 
    * @access public
    * @param string $number 問題番号
    * @return int 問題数
    */
    public function count($game_mode) {

    }

    public function getMultipleQuestions() {
        $query = 'SELECT * FROM m_questions';
        $results = [];

        $this->makeAPIQuery(1);
        
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
    * クエリーを生成する
    * 
    * @access private
    * @param string $number 問題番号
    * @return string $query 問い合わせるSQL文
    */
    private function makeAPIQuery($number) {
        $limit = Question::MUNBER_OF_QUESTIONS_DIC[$number];
        echo $limit;
        exit;
        $query = 'SELECT * FROM v_question_multiple_api ORDER BY RAND() LIMIT 1';
        
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
        $result = false;
        $query = 'INSERT INTO  m_questions (pattern_id, difficulty_id ,solution_time_id ,beast_house_id ,title ,problem_statement ,problem_image_path ,correct_answer ,incorrect_answer ,commentary)';
        $query .= ' VALUES (:pattern_id, :difficulty_id, :solution_time_id, :beast_house_id, :title, :problem_statement, :problem_image_path, :correct_answer, :incorrect_answer, :commentary)';

        try {

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':pattern_id', $prams[pattern_id], \PDO::PARAM_INT);
            $stmt->bindParam(':difficulty_id', $prams[difficulty], \PDO::PARAM_INT);
            $stmt->bindParam(':solution_time_id', $prams[solution_time], \PDO::PARAM_INT);
            $stmt->bindParam(':beast_house_id', $prams[area], \PDO::PARAM_INT);
            $stmt->bindParam(':title', $prams[title], \PDO::PARAM_STR);
            $stmt->bindParam(':problem_statement', $prams[introduction], \PDO::PARAM_STR);
            $stmt->bindParam(':problem_image_path', $prams[problem_image_path], \PDO::PARAM_STR);
            $stmt->bindParam(':correct_answer', $prams[correct_answer], \PDO::PARAM_STR);
            $stmt->bindParam(':incorrect_answer', $prams[incorrect_answer], \PDO::PARAM_STR);
            $stmt->bindParam(':commentary', $prams[commentary], \PDO::PARAM_STR);

            $stmt->execute();

            $result = true;

        } catch (PDOException $e) {
            throw $e;
        }
        return $result;
    }
}