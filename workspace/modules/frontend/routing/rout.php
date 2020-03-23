<?php

use core\App;

App::$collector->get('/', ['workspace\modules\frontend\controllers\FrontendController', 'actionIndex']);
App::$collector->get('category', ['workspace\modules\frontend\controllers\FrontendController', 'actionCategory']);
App::$collector->get('read', ['workspace\modules\frontend\controllers\FrontendController', 'actionRead']);