<?php

spl_autoload_register(function($class){
    $vendorDir = dirname(dirname(__FILE__));
    $file = "{$vendorDir}\\app\\{$class}.php";
    $file = str_replace("\\", DIRECTORY_SEPARATOR, $file);
    if(!file_exists($file)){
        throw new Exception("{$file} does not exist.");
    }
    include_once $file;
});
