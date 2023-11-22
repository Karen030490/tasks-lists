<?php
require_once "header.php";
?>
    <div >
        <?php

        if (!empty($_SESSION['error_login'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['error_login']; ?>
            </div>
            <?php
            unset($_SESSION['error_login']);
        }
        ?>
        <div class="" style="width: 400px;margin: 0 auto">
            <form class="form-group" method="post" action="<?= HOME_URL ?>/process-login">
                <div class="form-group">
                    <label for="login-username">Username</label>
                    <input type="text" name="username" required id="login-username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="pwd">Password</label>
                    <input type="password" name="password" required id="pwd" class="form-control">
                </div>
                <div>
                    <input type="submit" class="btn btn-primary" name="admin-login" value="Login">
                </div>
            </form>
        </div>
    </div>
<?php
require_once "footer.php";

