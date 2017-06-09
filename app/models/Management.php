<?php
/**
* Created by HIR0Y0SHI on 2017/06/09
*/

namespace App\Models;

use App\Mapper;

/**
* 従業員用のDBアクセスクラス
*
* @author HIR0Y0SHI
* @package Models
*/
class Management extends Mapper {

    public function getPass() {

    }

    /**
    * ユーザーの存在チェック
    * 
    * @access public
    * @param string $user ユーザー名
    * @return bool 存在結果
    * @throws PDOException
    */
    public function check($user, $pass) {
        $query = 'SELECT * FROM m_management_user WHERE login_id = :user AND password = :pass';

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user', $user, \PDO::PARAM_STR);
            $stmt->bindParam(':pass', $pass, \PDO::PARAM_STR);
            $stmt->execute();

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                return true;
            }

        } catch (PDOException $e) {
            throw $e;
        }

        return false;
    }
}