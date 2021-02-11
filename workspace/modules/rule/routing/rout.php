<?php

use core\App;

App::$collector->group(['prefix' => 'admin'], function ($router) {
    App::$collector->gridView('rules', ['workspace\modules\rule\controllers\RuleController']);
});