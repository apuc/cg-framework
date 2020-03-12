<?php

namespace workspace\modules\widgets\controllers;


use core\App;
use core\Controller;

class WidgetsController extends Controller
{
    public $viewPath = '/modules/widgets/views/';

    protected function init()
    {
        $this->viewPath = '/modules/widgets/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
    }
}