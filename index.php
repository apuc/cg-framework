<?php

require __DIR__ . '/vendor/autoload.php';

\core\App::start()->setConfig('main.php')->setRouting('rout.php')->run();