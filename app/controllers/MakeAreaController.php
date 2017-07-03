<?php
/**
 * Created by KUWANO on 2017/06/29
 */

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Area;

class MakeAreaController extends BaseController {

    /**
     * エリアを追加する
     *
     * @access public
     * @param array $params
     */
    public function addArea($params) {
        
        echo '<pre>';
        //var_dump($bh);
        var_dump($params);
        echo '</pre>';

        exit;
    }

    /**
     * エリアを更新する
     *
     * @access public
     * @param array $params
     */
    public function updateArea($params) {

        //$this->app->view->render($this->response, 'management/makeQuestion.html');
        echo '<pre>';
        //var_dump($bh);
        var_dump($params);
        echo '</pre>';
        exit;

    }

    /**
     * エリアを削除する
     *
     * @access public
     * @param array $params
     */
    public function deleteArea($params) {

        echo '<pre>';
        //var_dump($bh);
        var_dump($params);
        echo '</pre>';
        exit;

    }

}