<?php

error_reporting(-1);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

var_dump( parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));die();

\core\App::start()->setConfig()->setRouting()->run();