<?php

use core\App;

App::$collector->group(['prefix' => 'admin'], function ($router) {
    App::$collector->gridView('roles', ['workspace\modules\role\controllers\RoleController']);
});