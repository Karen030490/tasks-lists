<?php

namespace controller;

use model\Task;

class TaskController extends BaseController
{

    public function index()
    {
        $page = 0;
        $offset = 1;
        $sort = '';
        $order = '';
        $success_msg = $error_msg = '';

        if (!empty($_GET['page']) && (is_numeric($_GET['page']))) {
            $offset = (int)$_GET['page'];

            if ($offset == 1) {
                $page = 0;
            } else {
                $page = ($offset - 1) * 3;
            }
        }

        if (!empty($_GET['order'])) {
            $sort_by = !empty($_GET['sort'])?$_GET['sort']:'1';
            $sort = ($sort_by == '1')?'ASC':'DESC';

            switch ($_GET['order']) {
                case 'username':
                    $order = 'username';
                    break;
                case 'email':
                    $order = 'email';
                    break;
                case 'status':
                    $order = 'is_done';
                    break;
            }
        }

        if (!empty($_SESSION['task_success'])) {
            $success_msg = $_SESSION['task_success'];
            unset($_SESSION['task_success']);
        } elseif (!empty($_SESSION['error_task'])) {
            $error_msg = $_SESSION['error_task'];
            unset($_SESSION['error_task']);
        }

        $model = new Task();
        $limit = $model->limit;
        $tasks = $model->getTasksList($page, $order, $sort);
        $total_count = $model->getTasksCount();
        $total = (!empty($total_count) ? ceil($total_count['total'] / $limit) : 0);

        $is_admin = \Helper::isAdmin();

        $prev_url_params = array_merge($_GET, ['page' => ($offset - 1)]);
        $prev_page_url = http_build_query($prev_url_params);

        $next_url_params = array_merge($_GET, ['page' => ($offset + 1)]);
        $next_page_url = http_build_query($next_url_params);

        $this->render(
            'index',
            compact(
                'error_msg',
                'success_msg',
                'is_admin',
                'total',
                'prev_page_url',
                'next_page_url',
                'tasks',
                'limit',
                'offset'
            )
        );
    }

    public function addTask()
    {
        if (isset($_POST['add-new-task'])) {
            $username = !empty($_POST['username']) ? $_POST['username'] : '';
            $email = !empty($_POST['email']) ? $_POST['email'] : '';
            $text = !empty($_POST['task']) ? $_POST['task'] : '';

            if (!empty($email) && !empty($username) && !empty($text)) {
                if (!(filter_var(
                    $email,
                    FILTER_VALIDATE_EMAIL
                ))) {
                    $error = 'Email is not valid.';
                } else {
                    $model = new Task();
                    $task = trim(strip_tags($text));
                    $username = trim(strip_tags($username));
                    $email = trim(strip_tags($email));

                    $data = ['task' => $task, 'email' => $email, 'username' => $username];
                    $result = $model->setTask($data);

                    if (!empty($result)) {
                        $_SESSION['task_success'] = 'Successfully added new task';
                    }
                }
            } else {
                $error = "All fields are required!";
            }
        }

        if (!empty($error)) {
            $_SESSION['error_task'] = $error;
        }

        \Helper::redirect('');
    }


}