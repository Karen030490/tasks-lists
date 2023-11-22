<?php
require_once "header.php";
?>
<div>
    <form class="form-group" method="post" action="<?= HOME_URL ?>/admin/process-edit-task?id=<?= $task['id']?>">
        <div class="form-group">
            <label for="task-text">Task</label>
            <textarea rows="5" cols="7" name="task" required id="task-text"
                      class="form-control"><?= (!empty($task['task']))? $task['task']:'' ?></textarea>
        </div>
        <div class="form-group">
            <label for="task-done">Done</label>
            <input type="radio" id="task-done" value="1" name="is_done" <?= (!empty($task['is_done']) && ($task['is_done'] == 1)?'checked':'') ?>>
            <label for="task-not-done">Not Done</label>
            <input type="radio" id="task-not-done" value="0" name="is_done" <?= (empty($task['is_done']) || ($task['is_done'] == 0)?'checked':'') ?>>
        </div>
        <div>
            <a href="<?= HOME_URL?>/" class="btn btn-dark">Back</a>
            <input type="submit" name="update-task" value="Update" class="btn btn-success">

        </div>
    </form>
</div>
<?php
require_once "footer.php";
?>




