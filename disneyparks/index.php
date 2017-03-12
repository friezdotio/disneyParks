<?php

ini_set('max_execution_time', 300);
ini_set('display_errors', 1); 
error_reporting(E_ALL);


define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

if (file_exists(ROOT . 'vendor/autoload.php')) {
    require ROOT . 'vendor/autoload.php';
}

require 'config.php';

require APP . '/libs/pdo-debug.php';
require APP . '/core/application.php';
require APP . '/core/controller.php';
$app = new Application();

