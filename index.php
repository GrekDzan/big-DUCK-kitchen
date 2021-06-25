<?php

// FRONT CONTROLLER

// Общие настройки
ob_start();
ini_set('display_errors',0);
error_reporting(E_ALL);

session_start();

// Подключение файлов системы
define('ROOT', dirname(__FILE__));
// require_once(ROOT.'/components/Autoload.php');
require_once (ROOT. '/vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
$array_paths = array('models', 'components', 'controllers');

foreach ($array_paths as $path) {
    $file_names = scandir($path);
    foreach($file_names as $key => $file) {
        if (!($file == "." || $file == "..")) {
            // $path = ROOT . '/' . $path . '/' . $file;
            $pathToClass = ROOT . '/' . $path . '/' . $file;
            if (is_file($pathToClass)) {
                include_once $pathToClass;
            }
        }
    }
}

// Вызов Router
$router = new Router();
$router->run();






