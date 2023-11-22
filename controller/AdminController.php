<?php

namespace controller;

use model\Task;

class AdminController extends BaseController
{

    public function deleteTask()
    {
        if (\Helper::isAdmin() && !empty($_GET['id']) && (is_numeric($_GET['id']))) {
            $model = new Task();
            $model->deleteTask($_GET['id']);
        }

        \Helper::redirect('');
    }

    public function editTask()
    {
        if (\Helper::isAdmin() && !empty($_GET['id']) && (is_numeric($_GET['id']))) {
            $model = new Task();
            $task = $model->getTaskByID($_GET['id']);

            if (!empty($_POST['task']) && isset($_POST['update-task'])) {
                $is_done = !empty($_POST['is_done']) ? 1 : 0;
                $text = trim($_POST['task']);
                $data = ['task' => $text, 'is_done' => $is_done, 'updated_at' => date('Y-m-d H:i:s')];

                $result = $model->updateTask($data, $_GET['id']);
                if ($result) {
                    \Helper::redirect('');
                }
            }

            $this->render(
                'edit-task',
                ['task' => $task]
            );
        } else {
            \Helper::redirect('');
        }
    }


}