<?php

error_reporting(-1);
ini_set('display_errors', 1);
session_start();

require __DIR__ . '/vendor/autoload.php';

\core\App::start()->setConfig()->setRouting()->run();
