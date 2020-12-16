<?php

use core\App;

App::$collector->crud('tags', ['workspace\modules\tags\controllers\TagsController']);
