<?php

namespace workspace\modules\themes\controllers;

use core\Controller;

class ThemesController extends Controller
{
    public $viewPath = '/modules/themes/views/';

    public function actionIndex()
    {
        return $this->render('themes/themes.tpl', ['h1' => 'Themes']);
    }
}