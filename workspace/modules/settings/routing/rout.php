<?php

use core\App;

App::$collector->get('settings', ['workspace\modules\settings\controllers\SettingsController', 'actionIndex']);
App::$collector->crud('settings-crud', ['workspace\modules\settings\controllers\SettingsController']);