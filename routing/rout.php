<?php

use core\App;

App::$collector->get('/', ['workspace\controllers\MainController', 'actionIndex']);
App::$collector->get('/users', ['workspace\controllers\MainController', 'actionUsers']);
App::$collector->get('/send-form', ['workspace\controllers\SendController', 'actionIndex']);
App::$collector->get('products', function(){
    return 'Create Product';
});
App::$collector->get('/items/{id}', ['workspace\controllers\MainController', 'actionItems']);
App::$collector->get('/user/{id}', ['workspace\controllers\MainController', 'actionUser']);
App::$collector->get('/forms/{id}', ['workspace\controllers\FormsController', 'actionShow']);

App::$collector->get('admin', ['workspace\modules\adminpanel\controllers\AdminController', 'actionIndex']);

App::$collector->post('/get-article', ['workspace\controllers\ApiController', 'actionGetArticle']);
App::$collector->post('/set-options', ['workspace\controllers\ApiController', 'actionSetOptions']);
App::$collector->get('/get-options', ['workspace\controllers\ApiController', 'actionGetOptions']);

//App::$collector->crud('/news', ['workspace\controllers\NewsController']);

App::$collector->get('themes', ['workspace\modules\themes\controllers\ThemesController', 'actionIndex']);