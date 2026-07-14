<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $path;

if ($path !== '/' && is_file($file)) {
    return false;
}

// Route panel requests to the panel's index.php
if (strpos($path, '/panel') === 0) {
    $_SERVER['SCRIPT_NAME'] = '/panel/index.php';
    $_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/panel/index.php';
    require __DIR__ . '/panel/index.php';
    return;
}

$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/index.php';
require __DIR__ . '/index.php';
