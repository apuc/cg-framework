<?php

use core\App;

App::$collector->get('/send-form', ['workspace\controllers\SendController', 'actionIndex']);
App::$collector->get('products', function(){ return 'Create Product';});
App::$collector->get('/forms/{id}', ['workspace\controllers\FormsController', 'actionShow']);

App::$collector->get('admin', ['workspace\modules\adminpanel\controllers\AdminController', 'actionIndex']);

App::$collector->post('/store-article', ['workspace\controllers\ApiController', 'actionStoreArticle']);
App::$collector->post('/update-article', ['workspace\controllers\ApiController', 'actionUpdateArticle']);
App::$collector->post('/set-options', ['workspace\controllers\ApiController', 'actionSetOptions']);
App::$collector->get('/get-options', ['workspace\controllers\ApiController', 'actionGetOptions']);
App::$collector->post('/download', ['workspace\controllers\ApiController', 'actionDownload']);
App::$collector->post('/set-theme', ['workspace\controllers\ApiController', 'actionSetTheme']);

App::$collector->any('sign-up', ['workspace\controllers\MainController', 'actionSignUp']);
App::$collector->any('sign-in', ['workspace\controllers\MainController', 'actionSignIn']);
App::$collector->any('logout', ['workspace\controllers\MainController', 'actionLogout']);
App::$collector->any('modules', ['workspace\controllers\MainController', 'actionModules']);
App::$collector->any('module-download', ['workspace\controllers\MainController', 'actionModuleDownload']);
App::$collector->any('module-set-active', ['workspace\controllers\MainController', 'actionSetActive']);
App::$collector->any('module-set-inactive', ['workspace\controllers\MainController', 'actionSetInactive']);
App::$collector->any('module-delete', ['workspace\controllers\MainController', 'actionModuleDelete']);