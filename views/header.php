<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tasks List</title>
    <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="<?= HOME_URL ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= HOME_URL ?>/assets/css/style.css">
    <script src="<?= HOME_URL ?>/assets/js/jquery.min.js"></script>

</head>
<body>
<div class="container">


    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <span class="navbar-brand mb-0 h1">Task List</span>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= HOME_URL ?>/">Home</a>
                    </li>
                    <?php
                    if (!empty($_COOKIE['taskListAdmin'])) {
                        ?>
                        <li class="nav-item">
                            <form method="post" action="<?= HOME_URL ?>/logout">
                                <button type="submit" class="btn btn-info">Logout</button>
                            </form>
                        </li>

                        <?php
                    } else {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= HOME_URL ?>/login">Login</a>
                        </li>
                        <?php
                    }
                    ?>

                </ul>
            </div>
        </nav>
    </header>


