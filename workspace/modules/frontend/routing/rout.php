<?php

use core\App;

App::$collector->get('/', ['workspace\modules\frontend\controllers\FrontendController', 'actionIndex']);