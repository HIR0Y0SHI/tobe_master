<?php
/**
* Created by HIR0Y0SHI on 2017/06/26
*/

namespace App;

/**
* ログイン関連の認証を管理する
*
*/
class Auth {

    // public function __construct() {
    //     session_start();
    // }

    public static function check($app, $response) {
        
        // tobe_master Sessionの取得
        $session = new \SlimSession\Helper;

        // ログインされているかの確認
        if (!$session->exists('user')) {
            // return $app->view->render($response, 'management/login.html');
            // return $response->withRedirect($app->router->pathFor('login'));

            // MEMO: routerで実行すると、リダイレクトされるが、ここで実行しても動かない
            // $url = $app->router->pathFor('login');    
            // return $response->withStatus(302)->withHeader('Location', $url);

            // Redirectの処理がうまく動かないので強制
            header('Location: /tobe_master/login');
            exit;
        }
    }



    /**
    * ログイン時に実行する。
    * ログインするユーザー名をbase64に暗号化し,
    * tobe_masterのSessionに保存する。
    */
    public static function login($user) {
        $session = new \SlimSession\Helper;
        $session->user = base64_encode($user);
    }



    /**
    * ログアウト時に実行する。
    * tobe_masterのSessionを破棄する。
    */
    public static function logout() {
        $session = new \SlimSession\Helper;
        $session::destroy();

        // Redirectの処理がうまく動かないので強制
        header('Location: /tobe_master/login');
        exit;
    }
}