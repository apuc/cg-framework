<?php

use core\App;

App::$collector->group(['before' => 'auth'], function ($router) {
    App::$collector->group(['prefix' => 'admin'], function ($router) {
        App::$collector->get('product/download', ['workspace\modules\product\controllers\ProductController', 'actionDownload']);
        App::$collector->gridView('product', ['workspace\modules\product\controllers\ProductController']);
        //App::$collector->get('product',['workspace\modules\product\controllers\ProductController','actionIndex']);
    });
});

App::$collector->get('catalog', ['workspace\modules\product\controllers\TestFrontController', 'actionCatalog']);
App::$collector->any('testfront/order/{id}', ['workspace\modules\product\controllers\TestFrontController', 'actionOrder']);
App::$collector->any('testfront/oneproduct/{id}', ['workspace\modules\product\controllers\TestFrontController', 'actionOneProduct']);