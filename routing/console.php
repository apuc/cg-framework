<?php

use core\App;

App::$collector->console('run/parse', ['workspace\console\controllers\RunController', 'actionRun']);