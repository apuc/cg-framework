<?php

use core\App;

App::$collector->get('/', [workspace\controllers\MainController::class, 'actionIndex']);
App::$collector->get('/users', ['workspace\controllers\MainController', 'actionUsers']);
App::$collector->get('/send-form', ['workspace\controllers\SendController', 'actionIndex']);
App::$collector->get('products', function(){
    return 'Create Product';
});
App::$collector->get('/items/{id}', ['workspace\controllers\MainController', 'actionItems']);
App::$collector->get('/user/{id}', ['workspace\controllers\MainController', 'actionUser']);
App::$collector->get('/forms/{id}', ['workspace\controllers\FormsController', 'actionShow']);

App::$collector->get('admin', ['workspace\modules\adminpanel\controllers\AdminController', 'actionIndex']);

App::$collector->crud('/news', ['workspace\controllers\NewsController']);