<?php

spl_autoload_register(function ($classname) {
    // Can't use __DIR__ as it's only in PHP 5.3+
    $filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'class.' . strtolower($classname) . '.php';
    if (is_readable($filename)) {
        require $filename;
    }
});

?>
