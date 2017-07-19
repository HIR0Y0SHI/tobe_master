<?php
/**
 * Created by HIR0Y0SHI on 2017/06/05
 */

namespace App\Models;

use App\Mapper;

/**
 * エリア関連のDBアクセスクラス
 *
 * @author KUWANO
 * @package Models
 */
class Area extends Mapper {

    /**
     * エリアを登録する
     *
     * @access public
     * @param string $prams 入力パラメータ
     * @return bool trueなら成功
     */
    public function registration($prams) {
        $result = false;
        $query = 'INSERT INTO  m_beast_house (name)';
        $query .= ' VALUES(:name)';
        try {
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':name', $prams[area_name], \PDO::PARAM_STR);
            $stmt->execute();

            $result = true;
        } catch (PDOException $e) {
            throw $e;
        }
        return $result;

    }

    /**
     * エリアを更新する
     *
     * @access public
     * @param string $prams 入力パラメータ
     * @return bool trueなら成功
     */
    public function update($prams) {
        $result = false;
        $query = 'Update m_beast_house set name = :name ';
        $query .= ' where beast_house_id = :delete_no';
        try {
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':delete_no', $prams[beast_house_id], \PDO::PARAM_INT);
            $stmt->bindParam(':name', $prams[area_name], \PDO::PARAM_STR);
            $stmt->execute();

            $result = true;
        } catch (PDOException $e) {
            throw $e;
        }
        return $result;
    }

    /**
    * エリアを削除する
    *
    * @access public
    * @param string $prams 入力パラメータ
    * @return bool trueなら成功
    */
    public function delete($prams) {
        $result = false;
        $query = 'Delete from m_beast_house ';
        $query .= ' where beast_house_id = :delete_no';
        try {
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':delete_no', $prams[beast_house_id], \PDO::PARAM_STR);
            $stmt->execute();

            $result = true;
        } catch (PDOException $e) {
            throw $e;
        }
        return $result;
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
}