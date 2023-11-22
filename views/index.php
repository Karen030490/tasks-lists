<?php

require_once "header.php";
?>
<div class=" full-height">

    <div id="content" class=" full-height">
        <h1>Tasks List</h1>
        <div id="loading-content" class="full-height">
            <?php
            if (!empty($success_msg)) {
                ?>
                <div class="alert alert-success" role="alert">
                    <?= $success_msg; ?>
                </div>
                <?php
            } elseif (!empty($error_msg)) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error_msg; ?>
                </div>
                <?php
            }

            ?>
            <div class="mb-3 mt-3">
                <button type="button" class="btn btn-success" onclick="toggleNewTask()">+ Add new task</button>
                <div style="display: none" class="add-new-task">
                    <form class="form-group" method="post" action="<?= HOME_URL ?>/add-task">
                        <div class="form-group">
                            <label for="task-username">Username</label>
                            <input type="text" name="username" required id="task-username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="task-email">E-mail</label>
                            <input type="email" name="email" required id="task-email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="task-text">Task</label>
                            <textarea rows="5" cols="7" name="task" required id="task-text"
                                      class="form-control"></textarea>
                        </div>
                        <div>
                            <input type="submit" name="add-new-task" value="Add" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
            <div class="tasks mt-4" style="min-height: 200px">
                <table class="table text-left">
                    <thead>
                    <tr>
                        <th style="width: 30px">#</th>

                        <th style="width: 110px">User <a href="<?= HOME_URL?>/?order=username&sort=1&page=<?= $offset ?>" class="sort-by"></a> <a href="<?= HOME_URL?>/?order=username&sort=-1&page=<?= $offset ?>" class="sort-by"></a></th>
                        <th style="width: 200px">Email <a href="<?= HOME_URL?>/?order=email&sort=1&page=<?= $offset ?>" class="sort-by"></a> <a href="<?= HOME_URL?>/?order=username&sort=-1&page=<?= $offset ?>" class="sort-by"></a></th>
                        <th style="width: 250px">Task</th>
                        <th style="width: 110px">Status <a href="<?= HOME_URL?>/?order=status&sort=1&page=<?= $offset ?>" class="sort-by"> </a> <a href="<?= HOME_URL?>/?order=status&sort=-1&page=<?= $offset ?>" class="sort-by"> </a></th>
                        <?php
                        if (!empty($is_admin)) {
                            ?>
                            <th style="width: 160px"></th>
                            <?php
                        }
                        ?>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($tasks as $task) {
                        ?>
                        <tr>
                            <td><?= $task['id'] ?></td>
                            <td><?= $task['username'] ?></td>
                            <td><?= $task['email'] ?></td>
                            <td><?= $task['task'] ?></td>
                            <td><span class="badge badge-pill badge-<?= ($task['is_done'])?'success':'danger' ?>"><?= ($task['is_done'])?'&#10003;':'-' ?></span></td>
                            <?php
                            if (!empty($is_admin)) {
                                ?>
                                <td>
                                    <div><?= !empty($task['updated_at'])?('<div>updated at</div> <div>'. date('Y-m-d H:i:s', strtotime($task['updated_at'])).'</div>'):'';  ?></div>
                                    <a class="btn btn-info" href="<?= HOME_URL?>/admin/edit-task?id=<?= $task['id'];?>">edit</a>
                                    <div style="display: inline-block">
                                        <form id="task-delete-<?= $task['id'];?>" action="<?= HOME_URL?>/admin/delete-task?id=<?= $task['id'];?>" method="post">
                                            <button type="submit" class="btn btn-danger">delete</button>
                                        </form>
                                    </div>

                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>

                </table>

            </div>
            <div class="pagination-block mt-3">
                <?php
                if (!empty($total)) {

                    ?>
                    <ul class="pagination">
                        <?php
                        if ($offset > 1) {

                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?<?= $prev_page_url ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <?php
                        }
                        ?>

                        <?php
                        for ($i = 1; $i <= $total; $i++) {
                            $url_params = array_merge($_GET, ['page' => $i]);
                            $page_url = http_build_query($url_params);
                            ?>
                            <li class="page-item <?= ($offset == $i) ? 'active' : '' ?>">
                                <a class="page-link " href="?<?= $page_url ?>"><?= $i ?></a>
                            </li>
                            <?php
                        }
                        if ($offset < $total) {

                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?<?= $next_page_url ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                            <?php
                        }

                        ?>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once "footer.php";
?>


