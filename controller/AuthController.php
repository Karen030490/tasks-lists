<?php

namespace controller;

use model\Database;

class AuthController extends BaseController
{

    public function login()
    {
        if (isset($_POST['admin-login'])) {
            if (empty($_POST['username']) || empty($_POST['password'])) {
                $error = 'Username and Password are required';
            } else {
                $login = trim($_POST['username']);
                $pwd = trim($_POST['password']);

                $db = new Database('admin');
                $password = md5(base64_encode($pwd));
                $user_exists = $db->select(
                    "SELECT * FROM admin WHERE login = :login AND password =:pwd",
                    [":login" => $login, 'pwd' => $password]
                );

                if (!empty($user_exists) && $user_exists['is_admin']) {
                    $session_id = md5(base64_encode($user_exists['login'] . '-' . $user_exists['password']));
                    \Helper::setAdminAuth($session_id);
                    \Helper::redirect('');
                } else {
                    $error = 'Wrong credentials provided!';
                }
            }

            if (!empty($error)) {
                $_SESSION['error_login'] = $error;
            }

            \Helper::redirect('login');
        }

        $this->render('login');
    }

    public function logout()
    {
        if (isset($_COOKIE['taskListAdmin'])) {
            unset($_COOKIE['taskListAdmin']);
            setcookie('taskListAdmin', '', time() - 3600, '/');
        }

        \Helper::redirect('');

    }
}