<?php
/**
* Created by HIR0Y0SHI on 2017/06/10
*/

namespace App\Controllers;

use App\Models\Management;
use App\Controllers\BaseController;

class ManagementController extends BaseController {

    /**
    * ログイン
    * 
    * @access public
    * @param string $user ユーザー名
    */
    public function login($user, $pass) {
        $message = '';

        // ユーザー名の空白確認
        if (empty($user) || empty($pass)) {
            $message = 'ユーザー名またはパスワードが未入力です。';
        }

        // DBのチェック
        if (empty($this->app->db)) {
            $message = 'データベースが起動していません。';
        }

        $management = new Management($this->app->db);
        $enc_pass = base64_encode($pass);


        /*
         ユーザーの存在確認
        */
        if (empty($message)) {
            try {
                if ($management->check($user, $enc_pass)) {
                    /*
                     ユーザーが存在する
                    */

                    // セッション保存
                    App\Auth::login($user);

                    // 管理TOPをレンダー
                    // TODO: 遷移先を管理TOP画面に変更する
                    return $this->app->view->render($this->response, 'management/makeQuestion.html');
                } else {
                    // ユーザーが存在しない
                    $message = 'ユーザー名またはパスワードが間違えています。';
                }
            } catch (PDOException $e) {
                $message = 'データベースでエラーが発生しています。';
            }
        }

        return $this->app->view->render($this->response, 'management/login.html', array('message' => $message));        
    }



    public function loginCheck() {
        
    }
}