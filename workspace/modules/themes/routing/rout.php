<?php

use core\App;

App::$collector->gridView('themes', ['workspace\modules\themes\controllers\ThemesController']);
App::$collector->any('theme-set-active', ['workspace\modules\themes\controllers\ThemesController', 'actionSetActiveTheme']);