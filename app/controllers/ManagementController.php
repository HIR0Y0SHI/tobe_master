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
                    \App\Auth::login($user);

                    // 管理TOPをレンダー
                    // TODO: 遷移先を管理TOP画面に変更する
                    // MEMO: リダイレクトが動かない為ゴリ押し
                    header('Location: /tobe_master/management/quiz');
                    exit;
                    // return $this->app->view->render($this->response, 'management/topquestion.html');
                    // return $this->response->withStatus(302)->withHeader('Location', '/management/quiz');
                    // return $this->response->withRedirect('http://www.yahoo.co.jp/');
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