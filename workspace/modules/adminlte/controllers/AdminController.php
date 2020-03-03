<?php


namespace workspace\modules\adminlte\controllers;


use core\App;
use core\Controller;

class AdminController extends Controller
{
    protected function init()
    {
        $this->viewPath = '/modules/adminlte/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
    }

    public function actionIndex()
    {
        return $this->render('admin/index.tpl', ['h1' => 'AdminLte']);
    }

}