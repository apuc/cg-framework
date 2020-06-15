<?php
use core\App;

App::$collector->group(['before' => 'auth'], function ($router){
    App::$collector->group(['prefix' => 'admin'], function ($router){
        App::$collector->gridView('order', ['workspace\modules\order\controllers\OrderController']);
        App::$collector->get('order/upload/{id}', ['workspace\modules\order\controllers\OrderController', 'actionUpload']);
        //App::$collector->get('order',['workspace\modules\order\controllers\OrderController','actionIndex']);
    });
});


