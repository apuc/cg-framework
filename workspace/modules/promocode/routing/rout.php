<?php

use core\App;

App::$collector->group(['before' => 'auth'], function ($router) {
    App::$collector->group(['prefix' => 'admin'], function ($router) {
        App::$collector->gridView('promocode', ['workspace\modules\promocode\controllers\PromocodeController']);
        //App::$collector->get('promocode',['workspace\modules\promocode\controllers\PromocodeController','actionIndex']);
    });
});