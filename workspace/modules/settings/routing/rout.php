<?php

use core\App;

//App::$collector->get('settings', ['workspace\modules\settings\controllers\SettingsController', 'actionIndex']);
App::$collector->crud('settings', ['workspace\modules\settings\controllers\SettingsController']);
//App::$collector->post('edit', ['workspace\controllers\ApiController', 'actionEdit']);
//App::$collector->delete('delete', ['workspace\controllers\ApiController', 'actionDelete']);