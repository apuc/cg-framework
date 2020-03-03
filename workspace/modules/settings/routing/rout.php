<?php

use core\App;

App::$collector->get('settings', ['workspace\modules\settings\controllers\SettingsController', 'actionIndex']);