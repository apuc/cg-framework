<?php

use core\App;

//App::$collector->get('/', ['workspace\modules\frontend\controllers\FrontendController', 'actionIndex']);
App::$collector->get('category/{id}', ['workspace\modules\frontend\controllers\FrontendController', 'actionCategory']);
App::$collector->get('read/{id}', ['workspace\modules\frontend\controllers\FrontendController', 'actionRead']);
App::$collector->get('about', ['workspace\modules\frontend\controllers\FrontendController', 'actionAbout']);