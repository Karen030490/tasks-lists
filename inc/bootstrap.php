<?php
if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}

define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include main configuration file
require_once PROJECT_ROOT_PATH . "/config.php";
require_once PROJECT_ROOT_PATH . "/inc/routes.php";
require_once PROJECT_ROOT_PATH . "/helper/Helper.php";

// include the use model file
require_once PROJECT_ROOT_PATH . "/model/Database.php";
require_once PROJECT_ROOT_PATH . "/model/Task.php";
