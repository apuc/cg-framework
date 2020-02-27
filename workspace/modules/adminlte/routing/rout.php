<?php

use core\App;

App::$collector->get('adminlte', ['workspace\modules\adminlte\controllers\AdminController', 'actionIndex']);