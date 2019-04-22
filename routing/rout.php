<?php
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

$collector = new RouteCollector();
$collector->get('/', ['workspace\controllers\MainController', 'actionIndex']);
$collector->post('products', function(){
    return 'Create Product';
});
$collector->put('items/{id}', function($id){
    return 'Amend Item ' . $id;
});

return $collector;