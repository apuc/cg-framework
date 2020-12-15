<?php

use core\App;

App::$collector->any('users', ['workspace\modules\tags\controllers\TagsController']);
