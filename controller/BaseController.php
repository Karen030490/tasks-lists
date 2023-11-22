<?php

namespace controller;

class BaseController
{

    function render($file, $variables = array()) {
        extract($variables);

        $filename = PROJECT_ROOT_PATH.'views/' . $file . '.php';
        if (file_exists($filename)) {
            include $filename;
        }else{
            echo "View file is not found";
        }

        return '';
    }
}