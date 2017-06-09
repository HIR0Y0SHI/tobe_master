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
class Question extends \App\Mapper {

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
}