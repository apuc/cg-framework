<?php

use core\App;

App::$collector->crud('settings', ['workspace\modules\settings\controllers\SettingsController']);