<?php
/**
* Created by HIR0Y0SHI on 2017/06/26
*/

namespace App;

class Auth {

    // public function __construct() {
    //     session_start();
    // }

    public static function check($app, $response) {
        
        if (!isset($_SESSION['user'])) {
            return $app->view->render($response, 'management/login.html');
        }
    }


    public static function login($user) {
        $_SESSION['user'] = base64_encode($user);
    }


    public static function logout() {
        unset($_SESSION);
    }
}