<?php


namespace workspace\modules\adminlte\controllers;


use core\Controller;

class AdminController extends Controller
{
    public $viewPath = '/modules/adminlte/views/';

    public function actionIndex()
    {
        return $this->render('admin/index.tpl', ['h1' => 'AdminLte']);
    }

}