<?php
/**
* created by kuwano on 2017/07/16
*/

namespace App\Models;

use App\Mapper;

/**
* 問題関連のDBアクセスクラス
*
* @author kuwano
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

    /**
    * みんなで遊ぶ問題を取得する
    * 
    * @access public
    * @param string $number 問題番号
    * @return int 問題数
    */
    public function getMultipleQuestions($number) {
        $results = [];

        // クエリーを生成
        $query = $this->makeAPIQuery($number);
        
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
        return 'SELECT * FROM v_question_multiple_api WHERE difficulty_id = ' . $number . ' ORDER BY RAND() LIMIT ' . $limit;
    }


    /**
     * 問題一覧を取得する
     *
     * @access public
     * @return bool trueなら成功
     */
    public function getQuestion($page) {

        $page_start = null;
        unset($_SESSION['count']);
        unset($_SESSION['params']);

        if ($page > 1) {
            // 例：２ページ目の場合は、『(2 × 10) - 10 = 10』
            $page_start = ($page * 10) - 10;
        } else {
            $page_start = 0;
        }
        $query = 'SELECT * FROM m_questions as q INNER JOIN m_beast_house as b ';
        $query.= 'ON q.beast_house_id = b.beast_house_id ORDER BY question_id ';
        $query.= 'limit '.$page_start.',10';
        $results = [];

        $count = 'SELECT count(*) as num FROM m_questions as q INNER JOIN m_beast_house as b ';
        $count.= 'ON q.beast_house_id = b.beast_house_id ORDER BY question_id ';

        try {
            $stmt = $this->db->prepare($count);
            $stmt->execute();
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                // ページネーションの数を取得する
                $pagination = $row;
            }
            $pagination = ceil((int)$pagination['num'] / 10);
            $_SESSION['pagination'] = $pagination;

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
     * 難易度一覧を取得する
     *
     * @access public
     * @return bool trueなら成功
     */
    public function getDifficulty() {

        $query = 'SELECT * FROM m_difficulty ';
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
     * 時間一覧を取得する
     *
     * @access public
     * @return bool trueなら成功
     */
    public function getSolution() {

        $query = 'SELECT * FROM m_solution_time ';
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
     * 問題を検索
     *
     * @access public
     * @return bool trueなら成功
     */
    public function searchQuestion($params,$page) {

        if (!empty($_SESSION['params'])) {
            $params = $_SESSION['params'];
        }

        $page_start = null;
        if ($page > 1) {
            // 例：２ページ目の場合は、『(2 × 10) - 10 = 10』
            $page_start = ($page * 10) - 10;
        } else {
            $page_start = 0;
        }

        $query = 'SELECT * FROM m_questions as q INNER JOIN m_beast_house as b ';
        $query.= 'ON q.beast_house_id = b.beast_house_id where 1= 1';

        $count = 'SELECT count(*) as num FROM m_questions as q INNER JOIN m_beast_house as b ';
        $count.= 'ON q.beast_house_id = b.beast_house_id where 1= 1';

        if (!empty($params['keyword'])){
            $query .= ' AND commentary like (:keyword) ';
            $count .= ' AND commentary like (:keyword) ';
        }
        if (!empty($params['beast_house_id'])){
            $query .= ' AND q.beast_house_id = :beast_house_id ';
            $count .= ' AND q.beast_house_id = :beast_house_id ';
        }
        if (!empty($params['difficulty_id'])){
            $query .= ' AND difficulty_id = :difficulty_id ';
            $count .= ' AND difficulty_id = :difficulty_id ';
        }

        if (!empty($params['commentary_search'])){
            if ($params['commentary_search'] == 1) {
                $query .= ' AND commentary is not null ';
                $count .= ' AND commentary is not null ';
            }elseif ($params['commentary_search'] == 2) {
                $query .= ' AND commentary is null ';
                $count .= ' AND commentary is null ';
            }
        }

        $query.= ' ORDER BY question_id limit '.$page_start.',10';

        try {
            $stmt = $this->db->prepare($query);
            $stmt_count = $this->db->prepare($count);
            if (!empty($params['keyword'])){
                $keyword = "%".$params['keyword']."%";
                $stmt->bindParam(':keyword',$keyword, \PDO::PARAM_STR);
                $stmt_count->bindParam(':keyword',$keyword, \PDO::PARAM_STR);
            }
            if (!empty($params['beast_house_id'])){
                $stmt->bindParam(':beast_house_id',$params['beast_house_id'], \PDO::PARAM_INT);
                $stmt_count->bindParam(':beast_house_id',$params['beast_house_id'], \PDO::PARAM_INT);
            }
            if (!empty($params['difficulty_id'])){
                $stmt->bindParam(':difficulty_id',$params['difficulty_id'], \PDO::PARAM_INT);
                $stmt_count->bindParam(':difficulty_id',$params['difficulty_id'], \PDO::PARAM_INT);
            }
            $stmt_count->execute();
            while($row = $stmt_count->fetch(\PDO::FETCH_ASSOC)) {
                // ページネーションの数を取得する
                $pagination = $row;
            }

            $pagination = ceil((int)$pagination['num'] / 10);
            $_SESSION['pagination'] = $pagination;
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
        $sqlflg = 1;
        if(!($prams['commentary'])){
            $prams['commentary'] = null;
        }
        switch ($prams[pattern_id]) {
            case 1:
                $query = 'INSERT INTO  m_questions (pattern_id, difficulty_id ,solution_time_id ,beast_house_id ,title ,problem_statement ,problem_image_path ,correct_answer ,incorrect_answer ,commentary)';
                $query .= ' VALUES (:pattern_id, :difficulty_id, :solution_time_id, :beast_house_id, :title, :problem_statement, :problem_image_path, :correct_answer, :incorrect_answer, :commentary)';
                $sqlflg = 1;
                break;
            case 2:
                $query = 'INSERT INTO  m_questions (pattern_id, difficulty_id ,solution_time_id ,beast_house_id ,title ,problem_statement ,first_image_path ,second_image_path ,commentary)';
                $query .= ' VALUES (:pattern_id, :difficulty_id, :solution_time_id, :beast_house_id, :title, :problem_statement, :first_image_path, :second_image_path, :commentary)';
                $sqlflg = 2;
                break;
            case 3:
                $query = 'INSERT INTO  m_questions (pattern_id, difficulty_id ,solution_time_id ,beast_house_id ,title ,problem_statement ,first_image_path ,second_image_path ,correct_answer ,incorrect_answer ,commentary)';
                $query .= ' VALUES (:pattern_id, :difficulty_id, :solution_time_id, :beast_house_id, :title, :problem_statement, :first_image_path, :second_image_path, :correct_answer, :incorrect_answer, :commentary)';
                $sqlflg = 3;
                break;
        }


        try {
            $stmt = $this->db->prepare($query);
            switch ($sqlflg) {
                case 1:
                    $stmt->bindParam(':problem_image_path', $prams[problem_image_path], \PDO::PARAM_STR);
                    $stmt->bindParam(':correct_answer', $prams[correct_answer], \PDO::PARAM_STR);
                    $stmt->bindParam(':incorrect_answer', $prams[incorrect_answer], \PDO::PARAM_STR);
                    break;
                case 2:
                    $stmt->bindParam(':first_image_path', $prams[first_image_path], \PDO::PARAM_STR);
                    $stmt->bindParam(':second_image_path', $prams[second_image_path], \PDO::PARAM_STR);
                    break;
                case 3:
                    $stmt->bindParam(':correct_answer', $prams[correct_answer], \PDO::PARAM_STR);
                    $stmt->bindParam(':incorrect_answer', $prams[incorrect_answer], \PDO::PARAM_STR);
                    $stmt->bindParam(':first_image_path', $prams[first_image_path], \PDO::PARAM_STR);
                    $stmt->bindParam(':second_image_path', $prams[second_image_path], \PDO::PARAM_STR);
                    break;
            }

            $stmt->bindParam(':pattern_id', $prams[pattern_id], \PDO::PARAM_INT);
            $stmt->bindParam(':difficulty_id', $prams[difficulty], \PDO::PARAM_INT);
            $stmt->bindParam(':solution_time_id', $prams[solution_time], \PDO::PARAM_INT);
            $stmt->bindParam(':beast_house_id', $prams[area], \PDO::PARAM_INT);
            $stmt->bindParam(':title', $prams[title], \PDO::PARAM_STR);
            $stmt->bindParam(':problem_statement', $prams[introduction], \PDO::PARAM_STR);
            $stmt->bindParam(':commentary', $prams[commentary], \PDO::PARAM_STR);

            $stmt->execute();

            $result = true;

        } catch (PDOException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * 問題を編集する
     *
     * @access public
     * @param string $prams 入力パラメータ
     * @return bool trueなら成功
     */
    public function update($prams) {
        $result = false;
        $sqlflg = 1;
        switch ($prams[pattern_id]) {
            case 1:
                $query = 'UPDATE  m_questions ';
                $query .= 'SET pattern_id = :pattern_id ,difficulty_id = :difficulty_id ,solution_time_id = :solution_time_id ';
                $query .= ',beast_house_id = :beast_house_id ,title = :title ,problem_statement = :problem_statement ';
                $query .= ',correct_answer = :correct_answer ,incorrect_answer = :incorrect_answer ,commentary = :commentary ';

                if ($prams['problem_image_in']) {
                    $query .= ',problem_image_path = :problem_image_path ';
                }
                $query .= 'where question_id = :question_id';
                $sqlflg = 1;

                break;
            case 2:
                $query = 'UPDATE  m_questions ';
                $query .= 'SET pattern_id = :pattern_id ,difficulty_id = :difficulty_id ,solution_time_id = :solution_time_id ';
                $query .= ',beast_house_id = :beast_house_id ,title = :title ,problem_statement = :problem_statement ,commentary = :commentary ';

                if ($prams['correct_image_in']) {
                    $query .= ',first_image_path = :first_image_path ';
                }
                if ($prams['incorrect_image_in']) {
                    $query .= ',second_image_path = :second_image_path';
                }

                $query .= 'where question_id = :question_id';
                $sqlflg = 2;

                break;
            case 3:
                $query = 'UPDATE  m_questions ';
                $query .= 'SET pattern_id = :pattern_id ,difficulty_id = :difficulty_id ,solution_time_id = :solution_time_id ';
                $query .= ',beast_house_id = :beast_house_id ,title = :title ,problem_statement = :problem_statement ';
                $query .= ',correct_answer = :correct_answer ,incorrect_answer = :incorrect_answer ,commentary = :commentary ';

                if ($prams['first_problem_image_in']) {
                    $query .= ',first_image_path = :first_image_path ';
                }
                if ($prams['second_problem_image_in']) {
                    $query .= ',second_image_path = :second_image_path';
                }

                $query .= 'where question_id = :question_id';
                $sqlflg = 3;

                break;
        }


        try {
            $stmt = $this->db->prepare($query);
            switch ($sqlflg) {
                case 1:
                    if ($prams['problem_image_in']) {
                        $stmt->bindParam(':problem_image_path', $prams[problem_image_path], \PDO::PARAM_STR);
                    }
                    $stmt->bindParam(':correct_answer', $prams[correct_answer], \PDO::PARAM_STR);
                    $stmt->bindParam(':incorrect_answer', $prams[incorrect_answer], \PDO::PARAM_STR);
                    break;
                case 2:
                    if ($prams['correct_image_in']) {
                        $stmt->bindParam(':first_image_path', $prams[first_image_path], \PDO::PARAM_STR);
                    }
                    if ($prams['incorrect_image_in']) {
                        $stmt->bindParam(':second_image_path', $prams[second_image_path], \PDO::PARAM_STR);
                    }
                    break;
                case 3:
                    if ($prams['first_problem_image_in']) {
                        $stmt->bindParam(':first_image_path', $prams[first_image_path], \PDO::PARAM_STR);
                    }
                    if ($prams['second_problem_image_in']) {
                        $stmt->bindParam(':second_image_path', $prams[second_image_path], \PDO::PARAM_STR);
                    }
                    $stmt->bindParam(':correct_answer', $prams[correct_answer], \PDO::PARAM_STR);
                    $stmt->bindParam(':incorrect_answer', $prams[incorrect_answer], \PDO::PARAM_STR);
                    break;
            }

            $stmt->bindParam(':question_id', $prams[id], \PDO::PARAM_STR);
            $stmt->bindParam(':pattern_id', $prams[pattern_id], \PDO::PARAM_INT);
            $stmt->bindParam(':difficulty_id', $prams[difficulty], \PDO::PARAM_INT);
            $stmt->bindParam(':solution_time_id', $prams[solution_time], \PDO::PARAM_INT);
            $stmt->bindParam(':beast_house_id', $prams[area], \PDO::PARAM_INT);
            $stmt->bindParam(':title', $prams[title], \PDO::PARAM_STR);
            $stmt->bindParam(':problem_statement', $prams[introduction], \PDO::PARAM_STR);
            $stmt->bindParam(':commentary', $prams[commentary], \PDO::PARAM_STR);

            $stmt->execute();

            $result = true;

        } catch (PDOException $e) {
            throw $e;
        }
        return $result;
    }

    /**
     * 問題を削除する
     *
     * @access public
     * @param string $id 問題id
     * @return bool trueなら成功
     */
    public function deleteQuestion($id) {
        $result = false;
        $query = 'Delete from m_questions  ';
        $query .= ' where question_id = :delete_no';
        try {
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':delete_no', $id, \PDO::PARAM_INT);
            $stmt->execute();

            $result = true;
        } catch (PDOException $e) {
            throw $e;
        }
        return $result;
    }
}