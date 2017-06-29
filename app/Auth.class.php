<?php
/**
* Created by HIR0Y0SHI on 2017/06/26
*/

namespace App;

class Auth {

    // public function __construct() {
    //     session_start();
    // }

    public function check() {
        
        if (!isset($_SESSION['user'])) {
            echo 'ない';
        } else {
            echo $_SESSION['user'];
        }
    }

    public function logout() {
        unset($_SESSION);
    }
}