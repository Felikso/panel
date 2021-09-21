<?php

spl_autoload_register('vwAutoloader');

function vwAutoloader($className) {
    $path = 'classes/';
    $extenstion = '.php';
    $fullPath = $path . $className . $extenstion;

    if (!file_exists($fullPath)) {
        return false;
    }

    include_once $fullPath;
}