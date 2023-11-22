<?php

class Helper
{
    public static function isAdmin(){
        return (!empty($_COOKIE['taskListAdmin']));
    }

    public static function setAdminAuth($cookie_value){
        if(!isset($_COOKIE['taskListAdmin'])) {
            setcookie('taskListAdmin', $cookie_value, time() + (3600), "/");
        }
    }

    public static function redirect($url = '') {
        if(empty($url)){
            header("Location: ".HOME_URL);

        }else{
            header("Location: ".HOME_URL."/$url");

        }
        exit();
    }

}