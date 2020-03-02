<?php

use core\App;

App::$collector->console('run/parse', ['workspace\console\controllers\RunController', 'actionRun']);
App::$collector->console('migration/run', ['workspace\console\controllers\MigrationController', 'actionRun']);
App::$collector->console('migration/init', ['workspace\console\controllers\MigrationController', 'actionCreateMigrationTable']);
App::$collector->console('migration/create', ['workspace\console\controllers\MigrationController', 'actionCreate']);
App::$collector->console('migration/rollback', ['workspace\console\controllers\MigrationController', 'actionRollback']);

App::$collector->console('mod/list', ['workspace\console\controllers\ModController', 'actionList']);