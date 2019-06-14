<?php
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

$collector = new RouteCollector();
$collector->get('/', ['workspace\controllers\MainController', 'actionIndex']);
$collector->get('/send-form', ['workspace\controllers\SendController', 'actionIndex']);
$collector->get('products', function(){
    return 'Create Product';
});
$collector->get('/items/{id}', ['workspace\controllers\MainController', 'actionItems']);
$collector->get('/forms/{id}', ['workspace\controllers\FormsController', 'actionShow']);

return $collector;