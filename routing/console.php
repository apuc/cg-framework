<?php

use core\App;

App::$collector->console('run/parse', ['workspace\console\controllers\RunController', 'actionRun']);
App::$collector->console('migration/run', ['workspace\console\controllers\MigrationController', 'actionRun']);