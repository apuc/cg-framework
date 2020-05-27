<?php
use core\App;

App::$collector->get('product/download', ['workspace\modules\product\controllers\ProductController','actionDownload']);
App::$collector->gridView('product', ['workspace\modules\product\controllers\ProductController']);
//App::$collector->get('product',['workspace\modules\product\controllers\ProductController','actionIndex']);