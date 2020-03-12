<?php

use core\App;

App::$collector->crud('widgets', ['workspace\modules\widgets\controllers\WidgetsController']);