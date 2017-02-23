<?php

spl_autoload_register(function ($class) {
    $class_split = explode('\\', $class);
    $class_name = end($class_split);
    $file_name = dirname(__DIR__) . "/Models/$class_name.php";
    if (file_exists($file_name)) {
        require $file_name;
    }
});
