<?php
use core\App;

App::$collector->gridView('promocode', ['workspace\modules\promocode\controllers\PromocodeController']);
//App::$collector->get('promocode',['workspace\modules\promocode\controllers\PromocodeController','actionIndex']);